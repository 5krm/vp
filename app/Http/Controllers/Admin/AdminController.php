<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use DataTables;

class AdminController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function index(Request $request) {
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Access Denied: You do not have permission to view admins.');
        }

        $headerTitle = 'Admin List';

        if ($request->ajax()) {
            $query = Admin::query();

            // Apply status filter if present
            if (isset($request->status_filter) && $request->status_filter !== '') {
                $query->where('status', $request->status_filter);
            }

            return DataTables::of($query)
                        ->editColumn('status', function($admin) {
                            return $admin->status === 0 
                                ? '<span class="badge badge-success">Active</span>' 
                                : '<span class="badge badge-secondary">Inactive</span>';
                        })
                        ->addColumn('roles', function($admin) {
                            // Display roles
                            return $admin->roles->map(function($role) {
                                return '<span class="badge badge-success">' . $role->name . '</span>';
                            })->join(' ');
                        })
                        ->addColumn('actions', function($admin) {
                            return view('backend.admin.admin.partials.actions', compact('admin'))->render();
                        })
                        ->rawColumns(['status', 'roles', 'actions'])
                        ->make(true);
        }

        return view('backend.admin.admin.index', compact('headerTitle'));
    }

    public function add() {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            return back()->with('error', 'Access Denied: You do not have permission to create new admin accounts');
        }

        $data['headerTitle'] = 'Add New Admin';
        $data['roles']  = Role::all();

        return view('backend.admin.admin.add', $data);
    }

    public function insert(Request $request) {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Access Denied: You do not have permission to create new admin accounts');
        }

        $request->validate([
            'name' => 'required',
            'username' => ['required', 'max:255', Rule::unique('admins', 'username')],
            'email' => ['required', 'email', 'max:255', Rule::unique('admins', 'email')],
            'password' => 'required|string|min:8|confirmed'
        ]);

        $admin = new Admin;
        $admin->username = $request->username;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();

        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        return redirect('admin/admins')->with("success", "Admin successfully added");
    }

    public function edit($id) {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit admin accounts.');
        }

        $data['admin'] = Admin::find($id);

        if(!empty($data['admin'])) {
            $data['headerTitle'] = 'Edit Admin';
            $data['roles']  = Role::all();

            return view('backend.admin.admin.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit admin accounts.');
        }

        $admin = Admin::find($request->admin_id);

        $request->validate([
            'name' => 'required',
            'username' => [
                'required', 
                'max:255', 
                Rule::unique('admins', 'username')->ignore($admin->id)
                    ->when($request->username != $admin->username, function ($query) use ($request) {
                        return $query->where('username', $request->username);
                    }),
            ],
        ]);

        $admin->username = $request->username;
        $admin->name = $request->name;
        $admin->status = $request->status;
        $admin->save();

        $admin->roles()->detach();
        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        return redirect('admin/admins')->with("success", "Admin successfully updated");
    }

    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            return back()->with('error', 'Access Denied: You do not have permission to delete admin accounts.');
        }

        $admin = Admin::find($id);

        if (empty($admin)) {
            abort(404);  
        }

        if (\Auth::guard('admin')->check() && \Auth::guard('admin')->user()->email == 'admin@gmail.com') {
            try {
                $admin->delete();
                return redirect('admin/admins')->with("success", "Admin successfully deleted.");
            } catch (\Exception $e) {
                return redirect('admin/admins')->with("error", "Error deleting Admin: " . $e->getMessage());
            }
        }else {
            return redirect()->back()->with("error", "You do not have permission to delete admin");
        }
    }
}

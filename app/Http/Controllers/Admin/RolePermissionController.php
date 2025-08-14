<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DataTables;

class RolePermissionController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function index(Request $request) {
        if (is_null($this->user) || !$this->user->can('role.view')) {
            abort(403, 'Access Denied: You do not have permission to view roles.');
        }

        if ($request->ajax()) {
            $roles = Role::with('permissions')->get();

            return DataTables::of($roles)
                        ->addColumn('permissions', function ($role) {
                            return $role->permissions->pluck('name')->toArray();
                        })
                        ->addColumn('actions', function ($role) {
                            return view('backend.admin.role_and_permission.partials.actions', compact('role'))->render();
                        })
                        ->rawColumns(['permissions', 'actions'])
                        ->make(true);
        }

        $headerTitle = 'Role List';

        return view('backend.admin.role_and_permission.index', compact('headerTitle'));
    }

    public function add() {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            return back()->with('error', 'Access Denied: You do not have permission to create new roles.');
        }

        $data['headerTitle'] = 'Add New Role';
        $data['allPermissions'] = Permission::get();
        $data['permissionGroups'] = User::getPermissionGroups();

        return view('backend.admin.role_and_permission.add', $data);
    }

    public function insert(Request $request) {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            return back()->with('error', 'Access Denied: You do not have permission to create new roles.');
        }

        $request->validate([
            'name' => ['required', 'max:255', Rule::unique('roles', 'name')],
        ]);

        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);

        $permissions = $request->input('permissions');
        if(!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return redirect('admin/roles')->with("success", "Role successfully added.");
    }

    public function edit($id) {
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit roles.');
        }

        $data['role'] = Role::find($id);
        $data['allPermissions'] = Permission::get();
        $data['permissionGroups'] = User::getPermissionGroups();

        if(!empty($data['role'])) {
            $data['headerTitle'] = 'Edit Role';

            return view('backend.admin.role_and_permission.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to to edit roles.');
        }

        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $request->role_id
        ]);

        $role = Role::find($request->role_id);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }

        return redirect('admin/roles')->with("success", "Role successfully updated.");
    }

    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('role.delete')) {
            return back()->with('error', 'Access Denied: You do not have permission to to delete roles.');
        }

        $role = Role::find($id);

        if (empty($role)) {
            abort(404);  
        }

        $role->delete();

        return redirect('admin/roles')->with("success", "Role successfully deleted.");
    }

}

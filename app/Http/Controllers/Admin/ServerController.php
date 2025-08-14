<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Validator;
use DataTables;

class ServerController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function index(Request $request) {
        // if (is_null($this->user) || !$this->user->can('server.view')) {
        //     abort(403, 'Access Denied: You do not have permission to view servers.');
        // }

        $headerTitle = 'Server List';

        if ($request->ajax()) {
            $query = Server::latest();

            return DataTables::of($query)
                        ->addColumn('country_name', function ($server) {
                            return $server->country ? $server->country->name : 'N/A';
                        })
                        ->editColumn('status', function($server) {
                            return $server->status === 0 
                                ? '<span class="badge badge-success">Active</span>' 
                                : '<span class="badge badge-secondary">Inactive</span>';
                        })
                        ->addColumn('actions', function($server) {
                            return view('backend.admin.servers.partials.actions', compact('server'))->render();
                        })
                        ->rawColumns(['country_name', 'status', 'actions'])
                        ->make(true);
        }

        return view('backend.admin.servers.index', compact('headerTitle'));
    }

    public function add() {
        // if (is_null($this->user) || !$this->user->can('server.create')) {
        //     return back()->with('error', 'Access Denied: You do not have permission to create new server.');
        // }

        $data['headerTitle'] = 'Add New Server';
        $data['countries'] = Country::all();

        return view('backend.admin.servers.add', $data);
    }

    public function insert(Request $request) {
        // if (is_null($this->user) || !$this->user->can('server.create')) {
        //     abort(403, 'Access Denied: You do not have permission to create new server.');
        // }

        $rules = [
            'country_id' => 'required|exists:countries,id',
            'vpn_country' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'vpn_credentials_username' => 'required|string|max:255',
            'vpn_credentials_password' => 'required|string|min:8',
            'udp_configuration' => 'nullable|string',
            'tcp_configuration' => 'nullable|string',
            'access_type' => 'required|in:free,premium',
        ];

        $customMessage = [
            'country_id.required' => 'Please select a country',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $server = new Server;
        $server->country_id = $request->country_id;
        $server->vpn_country = $request->vpn_country;
        $server->name = $request->name;
        $server->vpn_credentials_username = $request->vpn_credentials_username;
        $server->vpn_credentials_password = $request->vpn_credentials_password;
        $server->udp_configuration = $request->udp_configuration;
        $server->tcp_configuration = $request->tcp_configuration;
        $server->access_type = $request->access_type;
        $server->save();

        return redirect('admin/servers')->with("success", "New server added successfully");
    }

    public function edit($id) {
        // if (is_null($this->user) || !$this->user->can('server.edit')) {
        //     return back()->with('error', 'Access Denied: You do not have permission to edit server.');
        // }

        $data['server'] = Server::find($id);

        if(!empty($data['server'])) {
            $data['headerTitle'] = 'Edit Radio';
            $data['countries'] = Country::all();

            return view('backend.admin.servers.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        // if (is_null($this->user) || !$this->user->can('server.edit')) {
        //     return back()->with('error', 'Access Denied: You do not have permission to edit server.');
        // }

        $server = Server::find($request->server_id);
        if (!$server) {
            return redirect()->back()->with('error', 'Server not found.');
        }

        $rules = [
            'country_id' => 'required|exists:countries,id', 
            'vpn_country' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'vpn_credentials_username' => 'required|string|max:255',
            'vpn_credentials_password' => 'required|string',
            'udp_configuration' => 'nullable|string',
            'tcp_configuration' => 'nullable|string',
            'access_type' => 'required|in:free,premium',
        ];

        $customMessage = [
            'country_id.required' => 'Please select a country',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $server->country_id = $request->country_id;
        $server->vpn_country = $request->vpn_country;
        $server->name = $request->name;
        $server->vpn_credentials_username = $request->vpn_credentials_username;
        $server->vpn_credentials_password = $request->vpn_credentials_password;
        $server->udp_configuration = $request->udp_configuration;
        $server->tcp_configuration = $request->tcp_configuration;
        $server->access_type = $request->access_type;
        $server->status = $request->status;
        $server->save();

        return redirect('admin/servers')->with("success", "Server updated successfully ");
    }

    public function delete($id)
    {
        // if (is_null($this->user) || !$this->user->can('server.delete')) {
        //     return back()->with('error', 'Access Denied: You do not have permission to delete server.');
        // }

        $server = Server::find($id);
        if (!$server) {
            return redirect()->back()->with('error', 'Server not found.');
        }

        $server->delete();

        return redirect()->back()->with(['success' => 'Server deleted successfully']);
    }
    

}

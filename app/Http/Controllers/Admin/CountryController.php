<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use DataTables;

class CountryController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function index(Request $request) {
        if (is_null($this->user) || !$this->user->can('country.view')) {
            abort(403, 'Access Denied: You do not have permission to view countries.');
        }

        $headerTitle = 'Country List';

        if ($request->ajax()) {
            $query = Country::query();

            if (!$request->has('order') || empty($request->order)) { 
                $query->orderBy('created_at', 'desc');
            }

            return DataTables::of($query)
                        ->editColumn('status', function($country) {
                            return $country->status === 0 
                                ? '<span class="badge badge-success">Active</span>' 
                                : '<span class="badge badge-secondary">Inactive</span>';
                        })
                        ->addColumn('actions', function($country) {
                            return view('backend.admin.countries.partials.actions', compact('country'))->render();
                        })
                        ->rawColumns(['status', 'actions'])
                        ->make(true);
        }

        return view('backend.admin.countries.index', compact('headerTitle'));
    }

    public function add(Request $request) {
        if (is_null($this->user) || !$this->user->can('country.create')) {
            return back()->with('error', 'Access Denied: You do not have permission to create new country.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $iconUrl = $this->handleUploadedFile($request->file('icon'));

        $country = new Country;
        $country->name = $request->name;
        $country->icon = $iconUrl; 
        $country->save();

        return response()->json([
            'status' => 'success',
            'message' => 'New country added successfully'
        ]);
    }

    public function getCountryById($id) {
        if (is_null($this->user) || !$this->user->can('country.edit')) {
            abort(403, 'Access Denied: You do not have permission to view country details.');
        }

        $country = Country::findOrFail($id);

        return response()->json($country);
    }

    public function update(Request $request) {
        if (is_null($this->user) || !$this->user->can('country.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit country.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $country = Country::find($request->country_id);

        if ($request->hasFile('icon')) {
            if ($country->icon && file_exists(public_path($country->icon))) {
                unlink(public_path($country->icon));
            } 

            $iconUrl = $this->handleUploadedFile($request->file('icon'));
            $country->icon = $iconUrl;
        }

        $country->name = $request->name;
        $country->status = $request->status;
        $country->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Country updated successfully'
        ]);
    }

    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('country.delete')) {
            return back()->with('error', 'Access Denied: You do not have permission to delete country.');
        }

        $country = Country::find($id);

        if (empty($country)) {
            abort(404);  
        }

        $country->delete();

        if ($country->icon && file_exists(public_path($country->icon))) {
            unlink(public_path($country->icon));
        } 

        return response()->json([
            'status' => 'success',
            'message' => 'Country deleted successfully'
        ]);
    }

    private function handleUploadedFile($file) {
        if ($file && $file->isValid()) {
            $timestamp = now()->timestamp;
            $directory = 'assets/uploads/countries/';
            $fileName = $timestamp . '_' . $file->getClientOriginalName();
            $file->move(public_path($directory), $fileName);
            return $directory . $fileName;
        }
        return null;
    }
}

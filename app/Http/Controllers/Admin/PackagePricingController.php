<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackagePricing;
use Illuminate\Support\Facades\Auth;
use Validator;
use DataTables;

class PackagePricingController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function index(Request $request) {
        if (is_null($this->user) || !$this->user->can('package_pricing.view')) {
            abort(403, 'Access Denied: You do not have permission to view package pricing list.');
        }

        $headerTitle = 'Pricing List'; 

        if ($request->ajax()) {
            $query = PackagePricing::latest();

            return DataTables::of($query)
                        ->editColumn('status', function($pricing) {
                            return $pricing->status === 0 
                                ? '<span class="badge badge-success">Active</span>' 
                                : '<span class="badge badge-secondary">Inactive</span>';
                        })
                        ->addColumn('actions', function($pricing) {
                            return view('backend.admin.package_pricing.partials.actions', compact('pricing'))->render();
                        })
                        ->rawColumns(['status', 'actions'])
                        ->make(true);
        }

        return view('backend.admin.package_pricing.index', compact('headerTitle'));
    }

    public function add() {
        if (is_null($this->user) || !$this->user->can('package_pricing.create')) {
            return back()->with('error', 'Access Denied: You do not have permission to create new pricing.');
        }

        $data['headerTitle'] = 'Add New Server';

        return view('backend.admin.package_pricing.add', $data);
    }

    public function insert(Request $request) {
        if (is_null($this->user) || !$this->user->can('package_pricing.create')) {
            abort(403, 'Access Denied: You do not have permission to create new pricing.');
        }

        $request->validate([
            'package_name' => 'required|string|max:255',
            'product_id' => 'required|string|max:255|regex:/^[A-Z0-9]+$/', 
            'package_duration' => 'required|integer|min:1',
            'package_price' => 'required|numeric|min:0.01', 
        ]);

        $pricing = new PackagePricing;
        $pricing->package_name = $request->package_name;
        $pricing->product_id = $request->product_id;
        $pricing->package_duration = $request->package_duration;
        $pricing->package_price = $request->package_price;
        $pricing->save();

        return redirect('admin/pricings')->with("success", "New pricing added successfully");
    }

    public function edit($id) {
        if (is_null($this->user) || !$this->user->can('package_pricing.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit pricing.');
        }

        $data['pricing'] = PackagePricing::find($id);

        if(!empty($data['pricing'])) {
            $data['headerTitle'] = 'Edit Pricing';

            return view('backend.admin.package_pricing.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        if (is_null($this->user) || !$this->user->can('package_pricing.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit pricing.');
        }

        $pricing = PackagePricing::find($request->pricing_id);
        if (!$pricing) {
            return redirect()->back()->with('error', 'Pricing not found.');
        }

        $request->validate([
            'package_name' => 'required|string|max:255',
            'product_id' => 'required|string|max:255|regex:/^[A-Z0-9]+$/', 
            'package_duration' => 'required|integer|min:1',
            'package_price' => 'required|numeric|min:0.01', 
        ]);

        $pricing->package_name = $request->package_name;
        $pricing->product_id = $request->product_id;
        $pricing->package_duration = $request->package_duration;
        $pricing->package_price = $request->package_price;
        $pricing->status = $request->status;
        $pricing->save();

        return redirect('admin/pricings')->with("success", "Pricing updated successfully ");
    }

    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('package_pricing.delete')) {
            return back()->with('error', 'Access Denied: You do not have permission to delete pricing.');
        }

        $pricing = PackagePricing::find($id);
        if (!$pricing) {
            return redirect()->back()->with('error', 'Pricing not found.');
        }

        $pricing->delete();

        return redirect()->back()->with(['success' => 'Pricing deleted successfully']);
    }
}

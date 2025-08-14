<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PackagePricing;
use App\Models\UserPackage;
use Illuminate\Support\Facades\Auth;
use DataTables;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function index(Request $request) {
        if (is_null($this->user) || !$this->user->can('user.view')) {
            abort(403, 'Access Denied: You do not have permission to view users.');
        }

        $headerTitle = 'User List';
        $pricings = PackagePricing::get();

        if ($request->ajax()) {
            $query = User::with(['userPackageDetails.packagePricing'])->select('users.*');
        
            // Apply default sorting if no sorting is passed from DataTables
            if (!$request->has('order') || empty($request->order)) {
                $query->orderBy('users.created_at', 'desc'); 
            }

            return DataTables::of($query)
                        ->editColumn('user_package_details.package_pricing.package_name', function ($user) {
                            return $user->userPackageDetails->packagePricing->package_name ?? 'N/A';
                        })
                        ->addColumn('actions', function($user) {
                            return view('backend.admin.users.partials.actions', compact('user'))->render();
                        })
                        ->rawColumns(['actions'])
                        ->make(true);
        }

        return view('backend.admin.users.index', compact('headerTitle', 'pricings'));
    }

    public function getUserById($id) {
        if (is_null($this->user) || !$this->user->can('user.edit')) {
            abort(403, 'Access Denied: You do not have permission to view user details.');
        }

        $user = User::with(['userPackageDetails'])->findOrFail($id);

        return response()->json(['user' => $user]);
    }

    public function update(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('user.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit user.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'nullable|exists:package_pricings,id', 
        ]);

        $user = User::findOrFail($request->user_id);

        if ($request->package_id) {
            $pricing = PackagePricing::findOrFail($request->package_id);

            $packageDuration = $pricing->package_duration;
            $purchaseTime = now();
            $expireTime = $purchaseTime->copy()->addDays($packageDuration); 

            $userPackage = UserPackage::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'package_id' => $request->package_id,
                    'package_duration' => $packageDuration,
                    'purchased_at' => $purchaseTime,
                    'expires_at' => $expireTime,
                ]
            );

            return response()->json(['success' => 'User package successfully updated']);
        }

        return response()->json(['success' => 'No package selected.'], 400);
    }

    public function delete($id) {
        if (is_null($this->user) || !$this->user->can('user.delete')) {
            return back()->with('error', 'Access Denied: You do not have permission to to delete user.');
        }

        $user = User::find($id);

        if (empty($user)) {
            abort(404);  
        }

        if ($user->profile_image && file_exists(public_path($user->profile_image))) {
            unlink(public_path($user->profile_image));
        }

        $user->tokens()->delete(); 
        $user->delete();

        return response()->json(['success' => 'User successfully deleted']);
    }

    
}

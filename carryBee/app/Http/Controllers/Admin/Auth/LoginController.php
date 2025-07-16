<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\DiscountRule;
use App\Models\Discount;
use App\Models\Admin;

class LoginController extends Controller
{
    //


    public function AdminshowLoginForm()
    {
        return view('admin.login');

    }

 
    public function DiscountData()
    {
        $defaultRates = [
            'same_city' => [ '0-200' => 49, '201-500' => 60, '501-1000' => 70, '1001-1500' => 80, '1501-2000' => 90, '2001-2500' => 100, '2500+' => 20 ],
            'dhk_sub' => [ '0-200' => 80, '201-500' => 85, '501-1000' => 100, '1001-1500' => 120, '1501-2000' => 125, '2001-2500' => 135, '2500+' => 20 ],
            'dhk_outside' => [ '0-200' => 99, '201-500' => 105, '501-1000' => 125, '1001-1500' => 140, '1501-2000' => 150, '2001-2500' => 160, '2500+' => 25 ],
            'outside_dhk' => [ '0-200' => 99, '201-500' => 105, '501-1000' => 110, '1001-1500' => 125, '1501-2000' => 125, '2001-2500' => 150, '2500+' => 25 ],
            'outside_outside' => [ '0-200' => 125, '201-500' => 125, '501-1000' => 135, '1001-1500' => 145, '1501-2000' => 155, '2001-2500' => 165, '2500+' => 25 ],
        ];

        $merchants = Discount::all();

        $groupedDiscounts = DiscountRule::get()
            ->groupBy('discount_id')
            ->map(function ($rules) {
                return $rules->groupBy('region')->map(function ($r) {
                    return $r->keyBy('weight_range');
                });
            });

        return view('admin.DiscountData', compact('merchants', 'defaultRates', 'groupedDiscounts'));
    }


public function AdminDashboard()
{
   $defaultRates = [
            'same_city' => [ '0-200' => 49, '201-500' => 60, '501-1000' => 70, '1001-1500' => 80, '1501-2000' => 90, '2001-2500' => 100, '2500+' => 20 ],
            'dhk_sub' => [ '0-200' => 80, '201-500' => 85, '501-1000' => 100, '1001-1500' => 120, '1501-2000' => 125, '2001-2500' => 135, '2500+' => 20 ],
            'dhk_outside' => [ '0-200' => 99, '201-500' => 105, '501-1000' => 125, '1001-1500' => 140, '1501-2000' => 150, '2001-2500' => 160, '2500+' => 25 ],
            'outside_dhk' => [ '0-200' => 99, '201-500' => 105, '501-1000' => 110, '1001-1500' => 125, '1501-2000' => 125, '2001-2500' => 150, '2500+' => 25 ],
            'outside_outside' => [ '0-200' => 125, '201-500' => 125, '501-1000' => 135, '1001-1500' => 145, '1501-2000' => 155, '2001-2500' => 165, '2500+' => 25 ],
        ];

        $merchants = Discount::all();

        $groupedDiscounts = DiscountRule::get()
            ->groupBy('discount_id')
            ->map(function ($rules) {
                return $rules->groupBy('region')->map(function ($r) {
                    return $r->keyBy('weight_range');
                });
            });
        $totalDiscounts = DiscountRule::sum('discounted_rate');
        $totalUsers = User::count();
        $totalAdmin = Admin::count();
     return view('admin.dashboard', compact('merchants', 'defaultRates', 'groupedDiscounts', 'totalDiscounts', 'totalUsers', 'totalAdmin'));
}


    public function Adminlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/admin/AdminDashboard');
        }

        return back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function Adminlogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }


      public function DiscountSlot($id)
    {

          $discount = Discount::findOrFail($id);

        // Optional security check to ensure user can only access own discount
       
        $rules = DiscountRule::where('discount_id', $discount->id)->get();


        return view('admin.DiscountSlot', compact('discount', 'rules'));
    }


}

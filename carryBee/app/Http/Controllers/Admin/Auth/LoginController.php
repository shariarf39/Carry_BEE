<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\DiscountRule;
use App\Models\Discount;

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
        'same_city' => [
            '0-200' => 49,
            '201-500' => 60,
            '501-1000' => 70,
            '1001-1500' => 80,
            '1501-2000' => 90,
            '2001-2500' => 100,
            '2500+' => 20, // per kg
        ],
        'dhk_sub' => [
            '0-200' => 80,
            '201-500' => 85,
            '501-1000' => 100,
            '1001-1500' => 120,
            '1501-2000' => 125,
            '2001-2500' => 135,
            '2500+' => 20,
        ],
        'dhk_outside' => [
            '0-200' => 99,
            '201-500' => 105,
            '501-1000' => 125,
            '1001-1500' => 140,
            '1501-2000' => 150,
            '2001-2500' => 160,
            '2500+' => 25,
        ],
        'outside_dhk' => [
            '0-200' => 99,
            '201-500' => 105,
            '501-1000' => 110,
            '1001-1500' => 125,
            '1501-2000' => 125,
            '2001-2500' => 150,
            '2500+' => 25,
        ],
        'outside_outside' => [
            '0-200' => 125,
            '201-500' => 125,
            '501-1000' => 135,
            '1001-1500' => 145,
            '1501-2000' => 155,
            '2001-2500' => 165,
            '2500+' => 25,
        ],
    ];

    $discountRules = DiscountRule::all();

    $totalPotentialRevenue = 0;
    $totalDiscounts = 0;
    $totalLoss = 0;

    foreach ($discountRules as $rule) {
        $region = strtolower(str_replace(' ', '_', $rule->region));
        $weight = strtolower($rule->weight_range);

        $defaultRate = $defaultRates[$region][$weight] ?? 0;
        $discountedRate = $rule->discounted_rate;

        $totalPotentialRevenue += $defaultRate;
        $totalDiscounts += $discountedRate;

        if ($weight === '2500+') {
            $loss = ($defaultRate > $discountedRate) ? ($defaultRate - $discountedRate) : 0;
        } else {
            $loss = max(0, $defaultRate - $discountedRate);
        }
        $totalLoss += $loss;
    }

    $totalActualRevenue = $totalPotentialRevenue - $totalDiscounts;
    $operationalCosts = $totalActualRevenue * 0.7;
    $netProfit = $totalActualRevenue - $operationalCosts;
    $totalUsers = User::count();

    $chartLabels = [];
    $profitData = [];
    $lossData = [];

    for ($i = 11; $i >= 0; $i--) {
        $date = now()->subMonths($i);
        $chartLabels[] = $date->format('M Y');

        $rules = DiscountRule::whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->get();

        $monthlyDiscounts = 0;
        $monthlyLoss = 0;

        foreach ($rules as $rule) {
            $region = strtolower(str_replace(' ', '_', $rule->region));
            $weight = strtolower($rule->weight_range);

            $defaultRate = $defaultRates[$region][$weight] ?? 0;
            $monthlyDiscounts += $rule->discounted_rate;

            if ($weight === '2500+') {
                $loss = ($defaultRate > $rule->discounted_rate) ? ($defaultRate - $rule->discounted_rate) : 0;
            } else {
                $loss = max(0, $defaultRate - $rule->discounted_rate);
            }

            $monthlyLoss += $loss;
        }

        $profitData[] = $monthlyDiscounts;
        $lossData[] = $monthlyLoss;
    }

    return view('admin.dashboard', compact(
        'netProfit',
        'totalDiscounts',
        'totalUsers',
        'totalActualRevenue',
        'chartLabels',
        'profitData',
        'lossData',
        'totalLoss'
    ));
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


}

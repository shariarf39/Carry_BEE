<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\DiscountRule;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('Client.pages.userDashboard');
    }


     public function storeDiscount(Request $request)
    {
        $validated = $request->validate([
        'merchant_id' => 'required|string',
        'merchant_name' => 'required|string',
        'merchant_email' => 'required|string',
        'onboarding_date' => 'required|date',
        'phone' => 'required|string',
        'pickup_hub' => 'required|string',
        'product_category' => 'required|string',
        'promised_parcels' => 'required|integer',
    ]);

    $discount = Discount::create([
        'merchant_id' => $validated['merchant_id'],
        'merchant_name' => $validated['merchant_name'],
        'merchant_email' => $validated['merchant_email'],
        'onboarding_date' => $validated['onboarding_date'],
        'phone' => $validated['phone'],
        'pickup_hub' => $validated['pickup_hub'],
        'product_category' => $validated['product_category'],
        'promised_parcels' => $validated['promised_parcels'],
        'requirements' => $request->input('requirements', []),
    ]);

    if ($request->has('region')) {
        for ($i = 0; $i < count($request->region); $i++) {
            DiscountRule::create([
                'discount_id' => $discount->id,
                'region' => $request->region[$i],
                'weight_range' => $request->weight_range[$i],
                'discounted_rate' => $request->discounted_rate[$i],
                'return_charge' => $request->return_charge[$i],
                'cod' => $request->cod[$i],
            ]);
        }
    }

    return redirect()->back()->with('success', 'Discount saved with rules.');
    }



    public function DiscountShow(Request $request)
    {
        $query = Discount::query();

        // Filter by logged-in user's email
        $userEmail = Auth::user()->email;
        $query->where('merchant_email', $userEmail);

        // Apply search if any
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('merchant_name', 'like', "%{$search}%")
                  ->orWhere('merchant_email', 'like', "%{$search}%")
                  ->orWhere('merchant_id', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $discounts = $query->latest()->get();

        return view('Client.pages.DiscountShow', compact('discounts'));
    }

    public function DiscountRuleShow($id)
    {
        $discount = Discount::findOrFail($id);

        // Optional security check to ensure user can only access own discount
        if ($discount->merchant_email !== Auth::user()->email) {
            abort(403);
        }

        $rules = DiscountRule::where('discount_id', $discount->id)->get();

        return view('Client.pages.DiscountRuleShow', compact('discount', 'rules'));
    }

}
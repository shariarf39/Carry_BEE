<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\DiscountRule;
use Illuminate\Support\Facades\Auth;
use App\Models\Hub;
use App\Models\Catagories;
use App\Models\KmaList;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function dashboard()
    {

        $locations = Hub::all(); // fetch all locations from DB
        $categories = Catagories::all(); // fetch all categories from DB
        $kmaList = KmaList::all(); // fetch all KMA list from DB

        // You can pass the categories to the view if needed
        return view('Client.pages.userDashboard', compact('locations', 'categories', 'kmaList'));
        // If you want to use the categories in the view, you can do so like this
    }

      public function DefaultRate()
    {
        return view('Client.pages.defultsRate');
    }
       public function Home()
    {
        return view('welcome');
    }


       public function storeDiscount(Request $request)
    {
        // **MODIFIED**: Added validation rules for the arrays of discount rules.
        $validated = $request->validate([
            'merchant_id' => 'required|string|max:255',
            'merchant_name' => 'required|string|max:255',
            'merchant_email' => 'required|email',
            'onboarding_date' => 'required|date',
            'phone' => 'required|string|max:20',
            'pickup_hub' => 'required|string|max:255',
            'product_category' => 'required|string|max:255',
            'kma' => 'required|string|max:255',
            'promised_parcels' => 'required|integer|min:0',
            'acquisition_type' => 'required|string|max:255',
            'business_owner' => 'required|string|max:255',
            
            // Validation for the custom rules, if they exist
            'region' => 'nullable|array',
            'region.*' => 'required_with:region|string',
            'weight_range' => 'nullable|array',
            'weight_range.*' => 'required_with:region|array', // Each rule must have weight ranges
            'weight_range.*.*' => 'required_with:region|string', // Each weight range must be a string
            'discounted_rate' => 'nullable|array',
            'discounted_rate.*' => 'required_with:region|numeric|min:0',
            'return_charge' => 'nullable|array',
            'return_charge.*' => 'required_with:region|numeric|min:0',
            'cod' => 'nullable|array',
            'cod.*' => 'required_with:region|numeric|min:0',
        ]);


         $existing = Discount::where('merchant_id', $validated['merchant_id'])
            ->where('is_active', 0)
            ->first();
        if ($existing) {
            return redirect()->back()->with('error', 'A request for this Merchant ID is already under discussion. Please wait for approval or rejection before submitting again.');
        }

        $discount = Discount::create([
            'merchant_id' => $validated['merchant_id'],
            'merchant_name' => $validated['merchant_name'],
            'merchant_email' => $validated['merchant_email'],
            'onboarding_date' => $validated['onboarding_date'],
            'phone' => $validated['phone'],
            'kma' => $validated['kma'],
            'pickup_hub' => $validated['pickup_hub'],
            'acquisition_type' => $validated['acquisition_type'],
            'business_owner' => $validated['business_owner'],
            'product_category' => $validated['product_category'],
            'promised_parcels' => $validated['promised_parcels'],
            'requirements' => $request->input('requirements', []), // requirements are optional checkboxes
        ]);

        // **MODIFIED**: This block now correctly loops through the structured data.
        // It iterates through each rule and then through each weight range within that rule.
        if ($request->has('region') && is_array($request->region)) {
            foreach ($request->region as $index => $regionValue) {
                // Ensure the corresponding weight_range for the current rule index exists and is an array.
                if (isset($request->weight_range[$index]) && is_array($request->weight_range[$index])) {
                    // Loop through each selected weight for the current rule.
                    foreach ($request->weight_range[$index] as $weight) {
                        DiscountRule::create([
                            'discount_id' => $discount->id,
                            'region' => $regionValue,
                            'weight_range' => $weight,
                            'discounted_rate' => $request->discounted_rate[$index],
                            'return_charge' => $request->return_charge[$index],
                            'cod' => $request->cod[$index],
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Discount has been saved successfully!');
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

       public function DeRuleShow($id)
    {

          $discount = Discount::findOrFail($id);

        // Optional security check to ensure user can only access own discount
        if ($discount->merchant_email !== Auth::user()->email) {
            abort(403);
        }
        $rules = DiscountRule::where('discount_id', $discount->id)->get();


        return view('Client.pages.defultsRate', compact('discount', 'rules'));
    }



     public function edit(Discount $discount)
    {
        // Load the related discount rules for this merchant
         $discount->load('rules');
        $discountRules = $discount->rules;

        // Fetch other necessary data for the form (e.g., KMA, locations, categories)
        $kmaList = KmaList::all();
        $locations = Hub::all();
        $categories = Catagories::all();

        // Pass all data to the new edit view
        return view('Client.pages.editdiscount', compact(
            'discount', 
            'discountRules', 
            'kmaList', 
            'locations', 
            'categories'
        ));
    }


 public function update(Request $request, Discount $discount)
    {
        $validatedData = $request->validate([
            'merchant_id' => 'required|string|max:255',
            'onboarding_date' => 'required|date',
            'merchant_name' => 'required|string|max:255',
            'promised_parcels' => 'required|integer|min:1',
            'phone' => 'required|string|max:255',
            'kma' => 'required|string|max:255',
            'pickup_hub' => 'required|string|max:255',
            'product_category' => 'required|string|max:255',
            'requirements' => 'array',
            'region' => 'nullable|array',
            'region.*' => 'required_with:region|string',
            'weight_range' => 'nullable|array',
            'weight_range.*' => 'required_with:region|array',
            'weight_range.*.*' => 'required_with:region|string',
            'discounted_rate' => 'nullable|array',
            'discounted_rate.*' => 'required_with:region|numeric|min:0',
            'return_charge' => 'nullable|array',
            'return_charge.*' => 'required_with:region|numeric|min:0',
            'cod' => 'nullable|array',
            'cod.*' => 'required_with:region|numeric|min:0',
        ]);

        $discount->update([
            'merchant_id' => $validatedData['merchant_id'],
            'onboarding_date' => $validatedData['onboarding_date'],
            'merchant_name' => $validatedData['merchant_name'],
            'promised_parcels' => $validatedData['promised_parcels'],
            'phone' => $validatedData['phone'],
            'kma' => $validatedData['kma'],
            'pickup_hub' => $validatedData['pickup_hub'],
            'product_category' => $validatedData['product_category'],
            'requirements' => $validatedData['requirements'] ?? null,
            'is_active' => 0,
        ]);

        $discount->rules()->delete();

        if ($request->has('region') && is_array($request->input('region'))) {
            foreach ($request->input('region') as $index => $region) {
                if (!empty($request->input("weight_range.$index"))) {
                    foreach ($request->input("weight_range.$index") as $weightRange) {
                        $discount->rules()->create([
                            'region' => $region,
                            'weight_range' => $weightRange,
                            'discounted_rate' => $request->input("discounted_rate.$index"),
                            'return_charge' => $request->input("return_charge.$index"),
                            'cod' => $request->input("cod.$index"),
                        ]);
                    }
                }
            }
        }

        return redirect()->route('discounts')->with('success', 'Discount updated successfully!');
    }

    public function export()
    {
        // Define the headers for the CSV file.
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="discounts.csv"',
        ];

        // Create a StreamedResponse to handle large datasets efficiently.
        $callback = function () {
            $file = fopen('php://output', 'w');

            // Write the column headers to the CSV file.
            fputcsv($file, [
                'Merchant Name',
                'Merchant ID',
                'Merchant Email',
                'Onboarding Date',
                'Phone',
                'KAM',
                'Pickup Hub',
                'Product Category',
                'Promised Parcels',
                'Special Requirements',
                'Region',
                'Weight Range',
                'Discounted Rate',
                'Return Charge (%)',
                'COD (%)',
                'Status'
            ]);

            // Fetch all discounts along with their associated rules.
            $discounts = Discount::with('rules')->get();

            foreach ($discounts as $discount) {
                // Determine the status label based on the is_active field.
                $status = 'Upon Discussion';
                if ($discount->is_active === 1) {
                    $status = 'Approved';
                } elseif ($discount->is_active === 2) { // Assuming 2 is for 'Rejected'
                    $status = 'Rejected';
                }

                // If a discount has custom rules, write a row for each rule.
                if ($discount->rules->isNotEmpty()) {
                    foreach ($discount->rules as $rule) {
                        fputcsv($file, [
                            $discount->merchant_name,
                            $discount->merchant_id,
                            $discount->merchant_email,
                            $discount->onboarding_date,
                            $discount->phone,
                            $discount->kma,
                            $discount->pickup_hub,
                            $discount->product_category,
                            $discount->promised_parcels,
                            implode(', ', (array) $discount->requirements),
                            $rule->region,
                            $rule->weight_range,
                            $rule->discounted_rate,
                            $rule->return_charge,
                            $rule->cod,
                            $status
                        ]);
                    }
                } else {
                    // If no custom rules exist, write a single row with default placeholders.
                    fputcsv($file, [
                        $discount->merchant_name,
                        $discount->merchant_id,
                        $discount->merchant_email,
                        $discount->onboarding_date,
                        $discount->phone,
                        $discount->kma,
                        $discount->pickup_hub,
                        $discount->product_category,
                        $discount->promised_parcels,
                        implode(', ', (array) $discount->requirements),
                        'Default', // Indicate that default rates apply
                        'N/A',
                        'N/A',
                        'N/A',
                        'N/A',
                        $status
                    ]);
                }
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

}
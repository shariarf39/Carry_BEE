<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Discount - {{ $discount->merchant_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #ecb90d;
            --primary-hover: #3a5bc7;
            --secondary-color: #6c757d;
            --light-bg: #f8f9fc;
            --border-color: #e3e6f0;
            --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            --border-radius: 0.5rem;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            padding: 1.25rem 1.5rem;
        }
        
        .form-control, .form-select {
            border-radius: var(--border-radius);
            padding: .75rem;
            border: 1px solid var(--border-color);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .btn {
            border-radius: var(--border-radius);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .btn-outline-secondary {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .badge {
            font-weight: 500;
            padding: 0.5em 0.75em;
            border-radius: 0.25rem;
        }
        
        .table th {
            font-weight: 600;
            color: #5a5c69;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        select[multiple] {
            min-height: 120px;
            padding: 0.5rem;
        }

        select[multiple] option {
            padding: 0.5rem;
            border-bottom: 1px solid #eee;
        }

        select[multiple] option:checked {
            background-color: #ecb90d;
            color: white;
        }

        .form-check-input:checked {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        .form-check.form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
        }
        
        .input-group-text {
            background-color: var(--light-bg);
            border-color: var(--border-color);
        }
        
        .user-badge {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 1rem;
            white-space: nowrap;
        }
        
        .section-header {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
        
        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
        }

        .weight-range-checkboxes {
            border: 1px solid #ecb90d;
            border-radius: 0.5rem;
            padding: 0.75rem;
            max-height: auto;
           
        }

        .weight-range-checkboxes .form-check {
            margin-bottom: 0.5rem;
            padding: 0.25rem;
            border-bottom: 2px solid #ecb90d;

        }

        .weight-range-checkboxes .form-check:last-child {
            border-bottom: none;
        }
        .form-check-input{
            border: 1px solid #ecb90d;
        }

        @media (max-width: 767.98px) {
            .responsive-table thead {
                display: none;
            }

            .responsive-table tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid var(--border-color);
                border-radius: var(--border-radius);
                padding: 1rem;
            }

            .responsive-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.5rem 0;
                border: none;
            }

            .responsive-table td::before {
                content: attr(data-label);
                font-weight: 600;
                padding-right: 1rem;
                text-align: left;
                flex-basis: 50%;
            }
            
            .responsive-table td:last-child {
                justify-content: flex-end;
            }
            
            .responsive-table td:last-child::before {
                display: none;
            }

            .main-header-flex {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center main-header-flex">
                <div>
                    <h4 class="mb-0">
                        <img src="logo/logo.png" alt="Logo" height="70" width="120" onerror="this.style.display='none'">
                        <i class="fas fa-edit me-2"></i>Edit Merchant: {{ $discount->merchant_name }}
                    </h4>
                    <div class="d-flex align-items-center mt-2 flex-wrap gap-2">
                        <span class="user-badge">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </span>
                        <span class="user-badge">
                            <i class="fas fa-envelope me-1"></i> {{ Auth::user()->email }}
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('discounts') }}" class="btn btn-sm btn-outline-light">
                        <i class="fas fa-chart-line me-1"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-md-4">
                <form method="POST" action="{{ route('discount.update', $discount->id) }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                                <i class="fas fa-percentage" style="color: #ecb90d; font-size: 1.5rem;"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1 fw-semibold">Discount Configuration</h6>
                                                <p class="text-muted small mb-0">Toggle ON for custom rules, OFF for defaults.</p>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" id="autoApplyToggle" onchange="toggleDiscountType()" style="width: 3.5rem; height: 1.75rem;" {{ $discountRules->isNotEmpty() ? 'checked' : '' }}>
                                            <label class="form-check-label" for="autoApplyToggle"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 border-primary">
                        <div class="card-header bg-light-primary d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-store me-2"></i>Merchant Information</h5>
                            <span class="badge bg-primary">Required Fields</span>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="merchant_id" class="form-label">Merchant ID</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" class="form-control" id="merchant_id" name="merchant_id" value="{{ old('merchant_id', $discount->merchant_id) }}" placeholder="MER12345" required>
                                        <div class="invalid-feedback">Please provide a merchant ID.</div>
                                    </div>
                                </div>
                                <input type="hidden" name="merchant_email" value="{{ old('merchant_email', $discount->merchant_email) }}">
                                <div class="col-md-6">
                                    <label for="onboarding_date" class="form-label">Onboarding Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="date" class="form-control" id="onboarding_date" name="onboarding_date" value="{{ old('onboarding_date', $discount->onboarding_date) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="merchant_name" class="form-label">Merchant Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="merchant_name" name="merchant_name" value="{{ old('merchant_name', $discount->merchant_name) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="promised_parcels" class="form-label">Promised Parcels/Day</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-box"></i></span>
                                        <input type="number" class="form-control" id="promised_parcels" name="promised_parcels" value="{{ old('promised_parcels', $discount->promised_parcels) }}" min="1" required>
                                        <span class="input-group-text">parcels</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $discount->phone) }}" required>
                                        <div class="invalid-feedback">Please provide a valid phone number.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <label for="kam_list" class="form-label">KAM LIST</label>
                                   <select class="form-select" id="kam_list" name="kma" required>
                                     <option value="" selected disabled>Select KAM</option>
                                     @foreach($kmaList as $kma)
                                     <option value="{{ $kma->name }}" {{ old('kma', $discount->kma) == $kma->name ? 'selected' : '' }}>{{ $kma->name }}</option>
                                     @endforeach
                                   </select>
                                </div>
                                <div class="col-md-6">
                                   <label for="pickup_hub" class="form-label">Pick Up Hub</label>
                                   <select class="form-select" id="pickup_hub" name="pickup_hub" required>
                                     <option value="" selected disabled>Select pick up hub</option>
                                     @foreach($locations as $location)
                                     <option value="{{ $location->location }}" {{ old('pickup_hub', $discount->pickup_hub) == $location->location ? 'selected' : '' }}>{{ $location->location }}</option>
                                     @endforeach
                                   </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="product_category" class="form-label">Product Category</label>
                                    <select class="form-select" id="product_category" name="product_category" required>
                                        <option value="" selected disabled>Select product category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->name }}" {{ old('product_category', $discount->product_category) == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 border-info">
                        <div class="card-header bg-light-info">
                            <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Special Requirements</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4 col-sm-6"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="requirements[]" value="pickup_time" id="pickupTime" {{ in_array('pickup_time', $discount->requirements ?? []) ? 'checked' : '' }}><label class="form-check-label" for="pickupTime">Specific Pickup Time</label></div></div>
                                <div class="col-md-4 col-sm-6"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="requirements[]" value="pickup_van" id="pickupVan" {{ in_array('pickup_van', $discount->requirements ?? []) ? 'checked' : '' }}><label class="form-check-label" for="pickupVan">Dedicated Pickup Van</label></div></div>
                                <div class="col-md-4 col-sm-6"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="requirements[]" value="entry_manual" id="entryManual" {{ in_array('entry_manual', $discount->requirements ?? []) ? 'checked' : '' }}><label class="form-check-label" for="entryManual">Manual Entry Facility</label></div></div>
                                <div class="col-md-4 col-sm-6"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="requirements[]" value="entry_csv" id="entryCSV" {{ in_array('entry_csv', $discount->requirements ?? []) ? 'checked' : '' }}><label class="form-check-label" for="entryCSV">CSV Entry Facility</label></div></div>
                                <div class="col-md-4 col-sm-6"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="requirements[]" value="close_box" id="closeBox" {{ in_array('close_box', $discount->requirements ?? []) ? 'checked' : '' }}><label class="form-check-label" for="closeBox">Close Box Requirement</label></div></div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 border-success" id="discountRulesCard" style="display:{{ $discountRules->isNotEmpty() ? 'block' : 'none' }}">
                        <div class="card-header bg-light-success d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-percentage me-2"></i>Custom Discount Rules</h5>
                            <button type="button" class="btn btn-sm btn-success" onclick="addDiscountRow()">
                                <i class="fas fa-plus me-1"></i>Add Rule
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle responsive-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Region</th>
                                            <th>Weight Range</th>
                                            <th>Discounted Rate</th>
                                            <th>Return Charge</th>
                                            <th>COD Charge</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="discountRows">
                                        @if($discountRules->isEmpty())
                                            <tr>
                                                <td data-label="Region">
                                                    <select class="form-select" name="region[0]" required>
                                                        <option value="" selected disabled>Select region</option>
                                                        <option value="same_city">Same City</option>
                                                        <option value="dhk_sub">DHK > Sub City</option>
                                                        <option value="dhk_outside">DHK > Outside City</option>
                                                        <option value="outside_dhk">Outside DHK > DHK</option>
                                                        <option value="outside_outside">Outside DHK > Outside DHK</option>
                                                    </select>
                                                </td>
                                                <td data-label="Weight Range">
                                                    <div class="weight-range-checkboxes">
                                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[0][]" value="0-200" id="weight0-200"><label class="form-check-label" for="weight0-200">0-200 gm</label></div>
                                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[0][]" value="201-500" id="weight201-500"><label class="form-check-label" for="weight201-500">201-500 gm</label></div>
                                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[0][]" value="501-1000" id="weight501-1000"><label class="form-check-label" for="weight501-1000">501-1000 gm</label></div>
                                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[0][]" value="1001-1500" id="weight1001-1500"><label class="form-check-label" for="weight1001-1500">1001-1500 gm</label></div>
                                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[0][]" value="1501-2000" id="weight1501-2000"><label class="form-check-label" for="weight1501-2000">1501-2000 gm</label></div>
                                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[0][]" value="2001-2500" id="weight2001-2500"><label class="form-check-label" for="weight2001-2500">2001-2500 gm</label></div>
                                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[0][]" value="2500+" id="weight2500+"><label class="form-check-label" for="weight2500+">2500+ per gm</label></div>
                                                    </div>
                                                </td>
                                                <td data-label="Discounted Rate">
                                                    <div class="input-group">
                                                        <span class="input-group-text">৳</span>
                                                        <input type="number" class="form-control" name="discounted_rate[0]" step="0.01" min="0" placeholder="0.00">
                                                    </div>
                                                </td>
                                                <td data-label="Return Charge">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="return_charge[0]" step="0.01" min="0" max="100" placeholder="0">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </td>
                                                <td data-label="COD Charge">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="cod[0]" min="0" step="0.01" max="100" placeholder="0">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </td>
                                                <td data-label="Actions" class="text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @else
                                            @php
                                                // Group rules by region to display them correctly
                                                $groupedRules = $discountRules->groupBy('region');
                                                $i = 0;
                                            @endphp
                                            @foreach($groupedRules as $region => $rules)
                                                <tr>
                                                    <td data-label="Region">
                                                        <select class="form-select" name="region[{{ $i }}]" required>
                                                            <option value="" disabled>Select region</option>
                                                            <option value="same_city" {{ $region == 'same_city' ? 'selected' : '' }}>Same City</option>
                                                            <option value="dhk_sub" {{ $region == 'dhk_sub' ? 'selected' : '' }}>DHK > Sub City</option>
                                                            <option value="dhk_outside" {{ $region == 'dhk_outside' ? 'selected' : '' }}>DHK > Outside City</option>
                                                            <option value="outside_dhk" {{ $region == 'outside_dhk' ? 'selected' : '' }}>Outside DHK > DHK</option>
                                                            <option value="outside_outside" {{ $region == 'outside_outside' ? 'selected' : '' }}>Outside DHK > Outside DHK</option>
                                                        </select>
                                                    </td>
                                                    <td data-label="Weight Range">
                                                        <div class="weight-range-checkboxes">
                                                            @foreach(['0-200', '201-500', '501-1000', '1001-1500', '1501-2000', '2001-2500'] as $weight)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="weight_range[{{ $i }}][]" value="{{ $weight }}" id="weight{{$i}}-{{ str_replace('+', '', $weight) }}" {{ $rules->pluck('weight_range')->contains($weight) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="weight{{$i}}-{{ str_replace('+', '', $weight) }}">{{ $weight }} gm</label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td data-label="Discounted Rate">
                                                        <div class="input-group">
                                                            <span class="input-group-text">৳</span>
                                                            <input type="number" class="form-control" name="discounted_rate[{{ $i }}]" step="0.01" min="0" value="{{ $rules->first()->discounted_rate }}">
                                                        </div>
                                                    </td>
                                                    <td data-label="Return Charge">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" name="return_charge[{{ $i }}]" step="0.01" min="0" max="100" value="{{ $rules->first()->return_charge }}">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </td>
                                                    <td data-label="COD Charge">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" name="cod[{{ $i }}]" min="0" step="0.01" max="100" value="{{ $rules->first()->cod }}">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </td>
                                                    <td data-label="Actions" class="text-center">
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @php $i++; @endphp
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between mt-4 gap-3">
                        <button type="reset" class="btn btn-outline-secondary order-sm-1">
                            <i class="fas fa-undo me-2"></i>Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary order-sm-2">
                            <i class="fas fa-save me-2"></i>Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggles the visibility of the discount rules section.
        function toggleDiscountType() {
            const toggle = document.getElementById("autoApplyToggle");
            const discountRulesCard = document.getElementById("discountRulesCard");

            if (toggle.checked) {
                discountRulesCard.style.display = "block";
            } else {
                discountRulesCard.style.display = "none";
            }
        }

        function addDiscountRow() {
            const container = document.getElementById('discountRows');
            const newIndex = container.children.length;
            const rowTemplate = document.createElement('tr');
            rowTemplate.innerHTML = `
                <td data-label="Region">
                    <select class="form-select" name="region[${newIndex}]" required>
                        <option value="" selected disabled>Select region</option>
                        <option value="same_city">Same City</option>
                        <option value="dhk_sub">DHK > Sub City</option>
                        <option value="dhk_outside">DHK > Outside City</option>
                        <option value="outside_dhk">Outside DHK > DHK</option>
                        <option value="outside_outside">Outside DHK > Outside DHK</option>
                    </select>
                </td>
                <td data-label="Weight Range">
                    <div class="weight-range-checkboxes">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[${newIndex}][]" value="0-200" id="weight${newIndex}-0-200"><label class="form-check-label" for="weight${newIndex}-0-200">0-200 gm</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[${newIndex}][]" value="201-500" id="weight${newIndex}-201-500"><label class="form-check-label" for="weight${newIndex}-201-500">201-500 gm</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[${newIndex}][]" value="501-1000" id="weight${newIndex}-501-1000"><label class="form-check-label" for="weight${newIndex}-501-1000">501-1000 gm</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[${newIndex}][]" value="1001-1500" id="weight${newIndex}-1001-1500"><label class="form-check-label" for="weight${newIndex}-1001-1500">1001-1500 gm</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[${newIndex}][]" value="1501-2000" id="weight${newIndex}-1501-2000"><label class="form-check-label" for="weight${newIndex}-1501-2000">1501-2000 gm</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[${newIndex}][]" value="2001-2500" id="weight${newIndex}-2001-2500"><label class="form-check-label" for="weight${newIndex}-2001-2500">2001-2500 gm</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="weight_range[${newIndex}][]" value="2500+" id="weight${newIndex}-2500+"><label class="form-check-label" for="weight${newIndex}-2500+">2500+ per gm</label></div>
                    </div>
                </td>
                <td data-label="Discounted Rate">
                    <div class="input-group">
                        <span class="input-group-text">৳</span>
                        <input type="number" class="form-control" name="discounted_rate[${newIndex}]" step="0.01" min="0" placeholder="0.00">
                    </div>
                </td>
                <td data-label="Return Charge">
                    <div class="input-group">
                        <input type="number" class="form-control" name="return_charge[${newIndex}]" step="0.01" min="0" max="100" placeholder="0">
                        <span class="input-group-text">%</span>
                    </div>
                </td>
                <td data-label="COD Charge">
                    <div class="input-group">
                        <input type="number" class="form-control" name="cod[${newIndex}]" min="0" step="0.01" max="100" placeholder="0">
                        <span class="input-group-text">%</span>
                    </div>
                </td>
                <td data-label="Actions" class="text-center">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;
            container.appendChild(rowTemplate);
        }

        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>
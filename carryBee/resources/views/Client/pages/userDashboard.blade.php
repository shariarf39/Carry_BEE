<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --light-primary: #e3ebf7;
            --success-color: #1cc88a;
            --light-success: #d4edda;
            --info-color: #36b9cc;
            --light-info: #d1ecf1;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: none;
        }
        
        .card-header {
            border-radius: 0.5rem 0.5rem 0 0 !important;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }
        
        .bg-primary {
            background-color: var(--primary-color) !important;
        }
        
        .bg-light-primary {
            background-color: var(--light-primary) !important;
        }
        
        .bg-light-success {
            background-color: var(--light-success) !important;
        }
        
        .bg-light-info {
            background-color: var(--light-info) !important;
        }
        
        .form-check.form-switch .form-check-input {
            width: 2.5em;
            height: 1.3em;
        }
        
        .table th {
            font-weight: 600;
            color: #5a5c69;
            font-size: 0.85rem;
            text-transform: uppercase;
        }
        
        .input-group-text {
            background-color: #f8f9fc;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .border-primary {
            border-color: var(--primary-color) !important;
        }
        
        .border-success {
            border-color: var(--success-color) !important;
        }
        
        .border-info {
            border-color: var(--info-color) !important;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-tags me-2"></i> Discount Management</h4>

                  <p>Welcome, {{ Auth::user()->name }}!</p>
                  <p>Welcome, {{ Auth::user()->email }}!</p>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
            </div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('storeDiscount') }}" class="needs-validation" novalidate>
                    @csrf

                    <!-- Toggle Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="autoApplyToggle" onchange="toggleDiscountType()">
                                <label class="form-check-label fw-bold" for="autoApplyToggle">
                                    <i class="fas fa-cog me-2"></i>Custom Discount Configuration
                                </label>
                                <small class="text-muted d-block mt-1">Toggle to switch between default and custom discount rules</small>
                            </div>
                        </div>
                    </div>

                    <!-- Merchant Information Section -->
                    <div class="card mb-4 border-primary">
                        <div class="card-header bg-light-primary d-flex justify-content-between align-items-center">
                            <span class="fw-bold"><i class="fas fa-store me-2"></i>Merchant Information</span>
                            <span class="badge bg-primary">Required</span>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="merchant_id" class="form-label">Merchant ID</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" class="form-control" id="merchant_id" name="merchant_id" placeholder="MER12345" required>
                                        <div class="invalid-feedback">Please provide a merchant ID.</div>
                                    </div>
                                </div>

                                <input type="hidden" name="merchant_email" value="{{ Auth::user()->email }}">

                                <div class="col-md-6">
                                    <label for="onboarding_date" class="form-label">Onboarding Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="date" class="form-control" id="onboarding_date" name="onboarding_date" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="merchant_name" class="form-label">Merchant Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="merchant_name" name="merchant_name" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="promised_parcels" class="form-label">Promised Parcels/Day</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-box"></i></span>
                                        <input type="number" class="form-control" id="promised_parcels" name="promised_parcels" min="1" required>
                                        <span class="input-group-text">parcels</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                        <div class="invalid-feedback">Please provide a valid phone number.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="pickup_hub" class="form-label">Pick Up Hub</label>
                                    <select class="form-select" id="pickup_hub" name="pickup_hub" required>
                                        <option value="" selected disabled>Select pick up hub</option>
                                        <option value="hub1">Hub 1 - Downtown</option>
                                        <option value="hub2">Hub 2 - Industrial Area</option>
                                        <option value="hub3">Hub 3 - East District</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="product_category" class="form-label">Product Category</label>
                                    <select class="form-select" id="product_category" name="product_category" required>
                                        <option value="" selected disabled>Select product category</option>
                                        <option value="electronics">Electronics</option>
                                        <option value="clothing">Clothing & Apparel</option>
                                        <option value="groceries">Groceries</option>
                                        <option value="pharmacy">Pharmacy</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Special Requirements Section -->
                    <div class="card mb-4 border-info">
                        <div class="card-header bg-light-info">
                            <span class="fw-bold"><i class="fas fa-clipboard-check me-2"></i>Special Requirements</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="pickup_time" id="pickupTime">
                                        <label class="form-check-label" for="pickupTime">Specific Pickup Time</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="pickup_van" id="pickupVan">
                                        <label class="form-check-label" for="pickupVan">Dedicated Pickup Van</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="entry_manual" id="entryManual" checked>
                                        <label class="form-check-label" for="entryManual">Manual Entry Facility</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="entry_csv" id="entryCSV">
                                        <label class="form-check-label" for="entryCSV">CSV Entry Facility</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="close_box" id="closeBox">
                                        <label class="form-check-label" for="closeBox">Close Box Requirement</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Discount Rules Section (Initially hidden) -->
                    <div class="card mb-4 border-success" id="discountRulesCard" style="display:none;">
                        <div class="card-header bg-light-success d-flex justify-content-between align-items-center">
                            <span class="fw-bold"><i class="fas fa-percentage me-2"></i>Custom Discount Rules</span>
                            <button type="button" class="btn btn-sm btn-success" onclick="addDiscountRow()">
                                <i class="fas fa-plus me-1"></i>Add Rule
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="20%">Region</th>
                                            <th width="20%">Weight Range</th>
                                            <th width="15%">Discounted Rate</th>
                                            <th width="15%">Return Charge (%)</th>
                                            <th width="15%">COD Charge (%)</th>
                                            <th width="15%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="discountRows">
                                        <!-- Discount row template -->
                                        <tr>
                                            <td>
                                                <select class="form-select" name="region[]" >
                                                    <option value="" selected disabled>Select region</option>
                                                    <option value="north">North Region</option>
                                                    <option value="south">South Region</option>
                                                    <option value="east">East Region</option>
                                                    <option value="west">West Region</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select" name="weight_range[]" >
                                                    <option value="" selected disabled>Select weight</option>
                                                    <option value="0-1kg">0-1 kg</option>
                                                    <option value="1-5kg">1-5 kg</option>
                                                    <option value="5-10kg">5-10 kg</option>
                                                    <option value="10+kg">10+ kg</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control" name="discounted_rate[]" step="0.01" min="0" placeholder="0.00" >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="return_charge[]" min="0" max="100" placeholder="0" >
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="cod[]" min="0" max="100" placeholder="0" >
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="fas fa-undo me-2"></i>Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Configuration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle discount rules section
        function toggleDiscountType() {
            const toggle = document.getElementById("autoApplyToggle");
            const discountRules = document.getElementById("discountRulesCard");
            discountRules.style.display = toggle.checked ? "block" : "none";
        }

        // Add new discount row
        function addDiscountRow() {
            const container = document.getElementById('discountRows');
            const row = container.firstElementChild.cloneNode(true);
            // Clear inputs
            row.querySelectorAll('input, select').forEach(el => {
                el.value = '';
                el.classList.remove('is-valid', 'is-invalid');
            });
            container.appendChild(row);
        }

        // Form validation
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
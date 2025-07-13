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
            padding: 0.75rem;
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
        
        .input-group-text {
            background-color: var(--light-bg);
            border-color: var(--border-color);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .form-check.form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
        }
        
        .user-badge {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 1rem;
        }
        
        .section-header {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
        
        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Header Card -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">
                        <i class="fas fa-tags me-2"></i>Discount Management
                    </h4>
                    <div class="d-flex align-items-center mt-2">
                        <span class="user-badge me-2">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </span>
                        <span class="user-badge">
                            <i class="fas fa-envelope me-1"></i> {{ Auth::user()->email }}
                        </span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('discounts') }}" class="btn btn-sm btn-outline-light me-2">
                        <i class="fas fa-chart-line me-1"></i> Reports
                    </a>
                    <a href="{{ route('defaultRate') }}" class="btn btn-sm btn-outline-light me-2">
                        <i class="fas fa-cog me-1"></i> Defaults
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('storeDiscount') }}" class="needs-validation" novalidate>
                    @csrf

                    <!-- Configuration Toggle -->
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
                            <h5 class="mb-0"><i class="fas fa-store me-2"></i>Merchant Information</h5>
                            <span class="badge bg-primary">Required Fields</span>
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
                            <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Special Requirements</h5>
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

                    <!-- Discount Rules Section -->
                    <div class="card mb-4 border-success" id="discountRulesCard" style="display:none;">
                        <div class="card-header bg-light-success d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-percentage me-2"></i>Custom Discount Rules</h5>
                            <button type="button" class="btn btn-sm btn-success" onclick="addDiscountRow()">
                                <i class="fas fa-plus me-1"></i>Add Rule
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
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
                                        <tr>
                                            <td>
                                                <select class="form-select" name="region[]">
                                                    <option value="" selected disabled>Select region</option>
                                                    <option value="north">North Region</option>
                                                    <option value="south">South Region</option>
                                                    <option value="east">East Region</option>
                                                    <option value="west">West Region</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select" name="weight_range[]">
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
                                                    <input type="number" class="form-control" name="discounted_rate[]" step="0.01" min="0" placeholder="0.00">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="return_charge[]" min="0" max="100" placeholder="0">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="cod[]" min="0" max="100" placeholder="0">
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
                            <i class="fas fa-save me-2"></i>Submit
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
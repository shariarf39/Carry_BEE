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

        /* --- Responsive Design Adjustments --- */
        
        /* Responsive table: On small screens, transform table to a list-like view */
        @media (max-width: 767.98px) {
            .responsive-table thead {
                display: none; /* Hide table headers */
            }

            .responsive-table tr {
                display: block; /* Each row becomes a block */
                margin-bottom: 1rem;
                border: 1px solid var(--border-color);
                border-radius: var(--border-radius);
                padding: 1rem;
            }

            .responsive-table td {
                display: flex; /* Use flexbox for alignment */
                justify-content: space-between; /* Align label and value */
                align-items: center;
                padding: 0.5rem 0;
                border: none;
            }

            .responsive-table td::before {
                content: attr(data-label); /* Use data-label for the header text */
                font-weight: 600;
                padding-right: 1rem;
                text-align: left;
                flex-basis: 50%; /* Give the label a consistent width */
            }
            
            .responsive-table td:last-child {
                 justify-content: flex-end; /* Center the delete button */
            }
            
            .responsive-table td:last-child::before {
                display: none; /* Don't show a label for the actions column */
            }

            /* Adjust the main header for better stacking on mobile */
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
        <!-- Header Card -->
        <div class="card mb-4">
            <!-- Added .main-header-flex for responsive stacking -->
            <div class="card-header d-flex justify-content-between align-items-center main-header-flex">
                <div>
                    <h4 class="mb-0">
                        <i class="fas fa-tags me-2"></i>Discount Management
                    </h4>
                    <!-- Added flex-wrap for user badges -->
                    <div class="d-flex align-items-center mt-2 flex-wrap gap-2">
                        <span class="user-badge">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </span>
                        <span class="user-badge">
                            <i class="fas fa-envelope me-1"></i> {{ Auth::user()->email }}
                        </span>
                    </div>
                </div>
                <!-- Added flex-wrap for header buttons -->
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('discounts') }}" class="btn btn-sm btn-outline-light">
                        <i class="fas fa-chart-line me-1"></i> Reports
                    </a>
                    <a href="{{ route('DefaultRate') }}" class="btn btn-sm btn-outline-light">
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
            <div class="card-body p-md-4">
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
                                     @foreach($locations as $location)
                                     <option value="{{ $location->location }}">{{ $location->location }}</option>
                                         @endforeach
                                 </select>
                                </div>


                                <div class="col-md-6">
                                    <label for="product_category" class="form-label">Product Category</label>
                                    <select class="form-select" id="product_category" name="product_category" required>
                                        <option value="" selected disabled>Select product category</option>
                                        <option value="electronics">Electronics</option>
                                        <option value="fashion">Fashion & Apparel</option>
                                        <option value="food">Food & Beverage</option>
                                        <option value="beauty">Beauty & Personal Care</option>
                                        <option value="home">Home & Living</option>
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
                            <!-- Using Bootstrap's grid for automatic wrapping and spacing -->
                            <div class="row g-3">
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="pickup_time" id="pickupTime">
                                        <label class="form-check-label" for="pickupTime">Specific Pickup Time</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="pickup_van" id="pickupVan">
                                        <label class="form-check-label" for="pickupVan">Dedicated Pickup Van</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="entry_manual" id="entryManual" checked>
                                        <label class="form-check-label" for="entryManual">Manual Entry Facility</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="entry_csv" id="entryCSV">
                                        <label class="form-check-label" for="entryCSV">CSV Entry Facility</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-check form-switch">
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
                            <!-- table-responsive will add horizontal scroll on larger screens if needed,
                                 but our custom CSS will handle small screens. -->
                            <div class="table-responsive">
                                <!-- Added .responsive-table class -->
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
                                        <tr>
                                            <!-- Added data-label attributes for responsive view -->
                                            <td data-label="Region">
                                                <select class="form-select" name="region[]">
                                                    <option value="" selected disabled>Select region</option>
                                                    <option value="same_city">Same City</option>
                                                    <option value="dhk_sub">DHK > Sub City</option>
                                                    <option value="dhk_outside">DHK > Outside City</option>
                                                    <option value="outside_dhk">Outside DHK > DHK</option>
                                                    <option value="outside_outside">Outside DHK > Outside DHK</option>
                                                </select>
                                            </td>
                                            <td data-label="Weight Range">
                                                <select class="form-select" name="weight_range[]">
                                                    <option value="" selected disabled>Select weight</option>
                                                    <option value="0-200">0-200 gm</option>
                                                    <option value="201-500">201-500 gm</option>
                                                    <option value="501-1000">501-1000 gm</option>
                                                    <option value="1001-1500">1001-1500 gm</option>
                                                    <option value="1501-2000">1501-2000 gm</option>
                                                    <option value="2001-2500">2001-2500 gm</option>
                                                    <option value="2500+">2500+ per gm</option>
                                                </select>
                                            </td>
                                            <td data-label="Discounted Rate">
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control" name="discounted_rate[]" step="0.01" min="0" placeholder="0.00">
                                                </div>
                                            </td>
                                            <td data-label="Return Charge">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="return_charge[]" min="0" max="100" placeholder="0">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td data-label="COD Charge">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="cod[]" min="0" max="100" placeholder="0">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td data-label="Actions" class="text-center">
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
                    <!-- Using responsive flex classes to stack buttons on small screens -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between mt-4 gap-3">
                        <button type="reset" class="btn btn-outline-secondary order-sm-1">
                            <i class="fas fa-undo me-2"></i>Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary order-sm-2">
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

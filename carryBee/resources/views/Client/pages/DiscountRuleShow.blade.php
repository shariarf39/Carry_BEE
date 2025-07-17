<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount Details | {{ $discount->merchant_name }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ecb90d;
            --secondary-color: #6c757d;
            --light-bg: #f8f9fc;
            --border-color: #e3e6f0;
            --success-color: #28a745;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 2rem;
        }
        
        .merchant-info {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .info-label {
            color: var(--secondary-color);
            font-weight: 500;
            width: 180px;
            display: inline-block;
        }
        
        .info-value {
            font-weight: 500;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background-color: #f8f9fc;
            color: #5a5c69;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom-width: 1px;
            padding: 1rem 1.25rem;
        }
        
        .table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-top: 1px solid var(--border-color);
        }
        
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .btn-back {
            border-radius: 0.25rem;
            padding: 0.5rem 1.25rem;
        }
        
        .currency {
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="page-header">
            <h3 class="mb-0">
                <i class="fas fa-tags me-2" style="color: #ecb90d;"></i>Discount Details for {{ $discount->merchant_name }}
            </h3>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-store me-2" style="color: #ecb90d;"></i>Information
                </h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <span class="info-label">KAM Email:</span>
                            <span class="info-value">{{ $discount->merchant_email }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="info-label">Phone:</span>
                            <span class="info-value">{{ $discount->phone }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="info-label">Pickup Hub:</span>
                            <span class="info-value">{{ $discount->pickup_hub }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <span class="info-label">Product Category:</span>
                            <span class="info-value text-capitalize">{{ $discount->product_category }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="info-label">Promised Parcels/Day:</span>
                            <span class="info-value">{{ $discount->promised_parcels }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-percentage me-2" style="color: #ecb90d;"></i>Discount Rules
                </h5>
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Region</th>
                                <th>Weight Range</th>
                                <th>Discounted Rate</th>
                                <th>Return Charge</th>
                                <th>COD Charge</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rules as $rule)
                            <tr>
                                <td>{{ $rule->region }}</td>
                                <td>{{ $rule->weight_range }}</td>
                                <td class="currency">৳{{ number_format($rule->discounted_rate, 2) }}</td>
                                <td>{{ $rule->return_charge }}%</td>
                                <td>{{ $rule->cod }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('discounts') }}" class="btn btn-secondary btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
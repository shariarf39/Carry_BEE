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
            --light-bg: #f8f9fc;
            --border-color: #e3e6f0;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }
        
        .table-responsive {
            border-radius: 0.5rem;
            overflow: hidden;
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
        
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            margin-right: 0.25rem;
            margin-bottom: 0.25rem;
            display: inline-block;
            border-radius: 0.25rem;
        }
        
        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
        }
        
        .search-box {
            border-radius: 0.25rem 0 0 0.25rem;
        }
        
        .search-btn {
            border-radius: 0 0.25rem 0.25rem 0;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="page-header">
            <h3 class="mb-0">
                <i class="fas fa-tags me-2 text-primary"></i>All Discounts
            </h3>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('discounts') }}" method="GET" class="row g-2">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   class="form-control search-box" 
                                   placeholder="Search by name, email, ID or phone">
                            <button type="submit" class="btn btn-primary search-btn">
                                <i class="fas fa-search me-1"></i> Search
                            </button>
                            <a href="{{ route('discounts') }}" class="btn btn-outline-secondary">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Merchant Name</th>
                                <th>Email</th>
                                <th>Merchant ID</th>
                                <th>Phone</th>
                                <th>Pickup Hub</th>
                                <th>Category</th>
                                <th>Parcels/Day</th>
                                <th>Requirements</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($discounts as $discount)
                            <tr>
                                <td>{{ $discount->merchant_name }}</td>
                                <td>{{ $discount->merchant_email }}</td>
                                <td>{{ $discount->merchant_id }}</td>
                                <td>{{ $discount->phone }}</td>
                                <td>{{ $discount->pickup_hub }}</td>
                                <td>{{ $discount->product_category }}</td>
                                <td>{{ $discount->promised_parcels }}</td>
                                <td>
                                    @foreach($discount->requirements ?? [] as $requirement)
                                        <span class="badge bg-primary">{{ ucwords(str_replace('_', ' ', $requirement)) }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('DiscountRuleShow', $discount->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('DeRuleShow', $discount->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View Rules
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
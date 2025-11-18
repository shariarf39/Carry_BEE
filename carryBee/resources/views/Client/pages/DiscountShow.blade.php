<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Discount Management Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root{
            --primary-color: #ecb90d;
            --secondary-color: #64748b;
            --light-bg: #f8fafc;
            --border-color: #e2e8f0;
            --success-color: #28a745;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .back-btn{
            background-color: var(--secondary-color);
            padding: 0.5rem 1rem;
            width: 170px;
            border-radius: 0.375rem;
            color: white;
            text-decoration: none;
            display: inline-block;
        }
        
        .back-btn:hover {
            background-color: #475569;
            color: white;
        }
        
        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary-custom:hover {
            background-color: #d6a70b;
            border-color: #d6a70b;
        }
        
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-approved {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>

    <div class="container py-4">
        
        <header class="mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-3">
                <div>
                    <h1 class="h2 fw-bold d-flex align-items-center mb-2">
                        <i class="fas fa-tags me-3" style="color: var(--primary-color);"></i>
                        Onboarding Dashboard
                    </h1>
                    <p class="text-muted mb-0">Manage and track all merchant discounts.</p>
                </div>
                <div>
                    <a href="{{ route('discounts.export') }}" class="btn btn-success">
                        <i class="fas fa-file-export me-2"></i>
                        Export Data
                    </a>
                </div>
            </div>
            <div class="mb-3">
                <a href="{{ route('dashboard') }}" class="back-btn">
                    <i class="fas fa-arrow-left me-2"></i>Back to Home
                </a>
            </div>
        </header>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('discounts') }}" method="GET" class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Search by name, email, ID or phone"
                            />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary-custom flex-grow-1">
                                <i class="fas fa-search me-2"></i>Search
                            </button>
                            <a href="{{ route('discounts') }}" class="btn btn-secondary">
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
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Merchant</th>
                                <th>Contact</th>
                                <th>Details</th>
                                <th>Additional Info</th>
                                <th>Requirements</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @forelse($discounts as $discount)
                            <tr>
                                
                                <td>
                                    <div class="fw-semibold">{{ $discount->merchant_name }}</div>
                                    <small class="text-muted">{{ $discount->merchant_id }}</small>
                                </td>

                                <td>
                                    <div>{{ $discount->merchant_email }}</div>
                                    <small class="text-muted">{{ $discount->phone }}</small>
                                </td>

                                <td>
                                    <div><strong>Hub:</strong> {{ $discount->pickup_hub }}</div>
                                    <div class="text-muted small"><strong>Category:</strong> {{ $discount->product_category }}</div>
                                    <div class="text-muted small"><strong>Parcels/Day:</strong> {{ $discount->promised_parcels }}</div>
                                </td>

                                <td>
                                    <div><strong>KAM:</strong> {{ $discount->kma ?? 'N/A' }}</div>
                                    <div class="text-muted small"><strong>Business Owner:</strong> {{ $discount->business_owner ?? 'N/A' }}</div>
                                    <div class="text-muted small"><strong>Acquisition:</strong> {{ $discount->acquisition_type ?? 'N/A' }}</div>
                                    <div class="text-muted small"><strong>Pickup Zone:</strong> {{ $discount->pickup_zone ?? 'N/A' }}</div>
                                    <div class="text-muted small"><strong>Merchant Type:</strong> {{ $discount->merchant_type ?? 'N/A' }}</div>
                                    <div class="text-muted small"><strong>Onboarding Date:</strong> {{ $discount->onboarding_date }}</div>
                                </td>

                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($discount->requirements ?? [] as $requirement)
                                        <span class="badge bg-primary small">
                                            {{ ucwords(str_replace('_', ' ', $requirement)) }}
                                        </span>
                                        @endforeach
                                    </div>
                                </td>

                                <td>
                                    @if($discount->is_active == 0)
                                        <span class="badge badge-pending">
                                            <i class="fas fa-clock me-1"></i> Upon Discussion
                                        </span>
                                    @elseif($discount->is_active == 1)
                                        <span class="badge badge-approved">
                                            <i class="fas fa-check-circle me-1"></i> Approved
                                        </span>
                                    @else
                                        <span class="badge badge-rejected">
                                            <i class="fas fa-times-circle me-1"></i> Rejected
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        @if($discount->is_active == 0)
                                        <a href="{{ route('discount.edit', $discount->id) }}" title="Edit" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endif

                                        <a href="{{ route('DiscountRuleShow', $discount->id) }}" title="View Details" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('DeRuleShow', $discount->id) }}" title="Manage Rules" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-list-check"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <h5 class="fw-semibold">No Discounts Found</h5>
                                    <p class="text-muted">There are no discounts matching your search criteria.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
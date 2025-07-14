<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Discount Management</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>

  <style>
    :root {
      --primary-color: #ecb90d;
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
      overflow-x: auto;
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
      white-space: nowrap;
    }

    .table tbody td {
      padding: 1rem 1.25rem;
      vertical-align: middle;
      border-top: 1px solid var(--border-color);
      word-break: break-word;
    }

    .badge {
      font-weight: 500;
      padding: 0.35em 0.65em;
      margin-right: 0.25rem;
      margin-bottom: 0.25rem;
      display: inline-block;
      border-radius: 0.25rem;
      word-break: break-word;
      white-space: normal;
    }

    .btn-sm {
      padding: 0.35rem 0.75rem;
      font-size: 0.875rem;
      border-radius: 0.25rem;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
      .table thead th, 
      .table tbody td {
        padding: 0.75rem;
      }
      
      .btn-sm {
        padding: 0.25rem 0.5rem;
      }
    }

    @media (max-width: 768px) {
      .card-body {
        padding: 1rem;
      }
      
      .table-responsive {
        border: 1px solid var(--border-color);
      }
      
      .table thead {
        display: none;
      }
      
      .table tbody tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        background: white;
      }
      
      .table tbody td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border-top: none;
        border-bottom: 1px solid var(--border-color);
      }
      
      .table tbody td:before {
        content: attr(data-label);
        font-weight: 600;
        margin-right: 1rem;
        color: #5a5c69;
        text-transform: uppercase;
        font-size: 0.75rem;
      }
      
      .table tbody td:last-child {
        border-bottom: none;
      }
      
      .table tbody td .d-flex {
        justify-content: flex-end;
        width: 100%;
      }
    }

    @media (max-width: 576px) {
      .input-group .btn span {
        display: none;
      }

      .input-group .btn i {
        margin: 0;
      }
      
      .page-header h3 {
        font-size: 1.25rem;
      }
      
      .badge {
        font-size: 0.75rem;
      }
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
        <!-- Search Form -->
        <form action="{{ route('discounts') }}" method="GET" class="row g-2 align-items-center">
          <div class="col-12 col-lg-8 col-xl-6">
            <div class="d-flex flex-wrap flex-sm-nowrap gap-2">
              <div class="input-group flex-grow-1">
                <input
                  type="text"
                  name="search"
                  value="{{ request('search') }}"
                  class="form-control"
                  placeholder="Search by name, email, ID or phone"
                />
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-search"></i>
                  <span class="d-none d-sm-inline ms-1">Search</span>
                </button>
              </div>
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
                <td data-label="Merchant Name">{{ $discount->merchant_name }}</td>
                <td data-label="Email">{{ $discount->merchant_email }}</td>
                <td data-label="Merchant ID">{{ $discount->merchant_id }}</td>
                <td data-label="Phone">{{ $discount->phone }}</td>
                <td data-label="Pickup Hub">{{ $discount->pickup_hub }}</td>
                <td data-label="Category">{{ $discount->product_category }}</td>
                <td data-label="Parcels/Day">{{ $discount->promised_parcels }}</td>
                <td data-label="Requirements">
                  @foreach($discount->requirements ?? [] as $requirement)
                  <span class="badge bg-primary">
                    {{ ucwords(str_replace('_', ' ', $requirement)) }}
                  </span>
                  @endforeach
                </td>
                <td data-label="Actions">
                  <div class="d-flex flex-column flex-sm-row gap-2">
                    <a href="{{ route('DiscountRuleShow', $discount->id) }}" class="btn btn-info btn-sm">
                      <i class="fas fa-eye me-1"></i> <span class="d-none d-sm-inline">View</span>
                    </a>
                    <a href="{{ route('DeRuleShow', $discount->id) }}" class="btn btn-secondary btn-sm">
                      <i class="fas fa-list-check me-1"></i> <span class="d-none d-sm-inline">Rules</span>
                    </a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
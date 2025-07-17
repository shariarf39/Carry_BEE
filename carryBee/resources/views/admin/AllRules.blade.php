<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CarryBee Default Rates</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    :root {
      --primary-color: #003d4d;
      --secondary-color: #006680;
      --light-bg: #f8f9fa;
      --border-color: #dee2e6;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--light-bg);
      color: #333;
    }
    
    .page-header {
      border-bottom: 2px solid var(--primary-color);
      padding-bottom: 1rem;
      margin-bottom: 2rem;
    }
    
    .table-container {
      border-radius: 0.5rem;
      overflow: hidden;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
      margin-bottom: 3rem;
    }
    
    .table {
      margin-bottom: 0;
    }
    
    .table thead th {
      background-color: var(--primary-color);
      color: white;
      font-weight: 600;
      text-align: center;
      vertical-align: middle;
      padding: 1rem;
      border-bottom: none;
    }
    
    .table tbody td {
      vertical-align: middle;
      padding: 0.75rem;
      text-align: center;
      border-color: var(--border-color);
    }
    
    .table tbody tr:nth-child(even) {
      background-color: rgba(0, 61, 77, 0.03);
    }
    
    .title-row {
      background-color: rgba(0, 204, 102, 0.1) !important;
    }
    
    .title-row td {
      font-weight: 600;
      color: var(--primary-color);
      text-align: left !important;
      padding: 1rem;
      font-size: 1.1rem;
    }
    
    .highlight {
      font-weight: 600;
      color: var(--primary-color);
    }
    
    .weight-range {
      font-weight: 500;
      color: var(--secondary-color);
    }
    
    .info-label {
      font-weight: 600;
      color: var(--primary-color);
      margin-right: 0.5rem;
    }
    
    .merchant-section {
      background-color: rgba(0, 61, 77, 0.05);
      border-radius: 0.5rem;
      padding: 1rem;
      margin-bottom: 2rem;
      border-left: 4px solid var(--primary-color);
    }
    
    .export-all-btn {
      margin-bottom: 2rem;
    }
    
    @media (max-width: 992px) {
      .table-container {
        border: 1px solid var(--border-color);
      }
      
      .table thead th {
        font-size: 0.8rem;
        padding: 0.75rem 0.5rem;
      }
      
      .table tbody td {
        font-size: 0.85rem;
        padding: 0.5rem;
      }
      
      .title-row td {
        font-size: 0.95rem;
      }
    }
    
    @media (max-width: 768px) {
      .table thead {
        display: none;
      }
      
      .table, .table tbody, .table tr, .table td {
        display: block;
        width: 100%;
      }
      
      .table tr {
        margin-bottom: 1rem;
        border: 1px solid var(--border-color);
        border-radius: 0.25rem;
      }
      
      .table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
        border-bottom: 1px solid var(--border-color);
      }
      
      .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 1rem;
        width: calc(50% - 1rem);
        padding-right: 1rem;
        font-weight: 600;
        text-align: left;
        color: var(--primary-color);
      }
      
      .title-row td {
        text-align: center !important;
        padding-left: 1rem;
      }
      
      .title-row td::before {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="container py-4">
    <div class="page-header">
      <h2 class="mb-0">
        <i class="fas fa-truck me-2" style="color: var(--primary-color);"></i>CarryBee Default Rates
      </h2>
    </div>

    <!-- Global Export Button -->
    <button class="btn btn-success export-all-btn">
      <i class="fas fa-download me-1"></i> Export All Merchants CSV
    </button>

    @if($discounts->isEmpty())
      <div class="alert alert-info">No discounts found</div>
    @else
      @foreach($discounts as $discount)
      <div class="merchant-section" id="merchant-{{ $discount->id }}">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3 class="mb-0">
            <i class="fas fa-store me-2"></i>{{ $discount->merchant_name }}
          </h3>
        </div>
        
        <div class="row mb-4">
          <div class="col-md-6">
            <div class="mb-2">
              <span class="info-label">Merchant Email:</span>
              <span class="info-value">{{ $discount->merchant_email }}</span>
            </div>
            <div class="mb-2">
              <span class="info-label">Phone:</span>
              <span class="info-value">{{ $discount->phone }}</span>
            </div>
            <div class="mb-2">
              <span class="info-label">Pickup Hub:</span>
              <span class="info-value">{{ $discount->pickup_hub }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-2">
              <span class="info-label">Product Category:</span>
              <span class="info-value text-capitalize">{{ $discount->product_category }}</span>
            </div>
            <div class="mb-2">
              <span class="info-label">Promised Parcels/Day:</span>
              <span class="info-value">{{ $discount->promised_parcels }}</span>
            </div>
          </div>
        </div>
        
        <div class="table-container">
          <table class="table table-bordered merchant-table" id="table-{{ $discount->id }}">
            <thead>
              <tr>
                <th>Merchant ID</th>
                <th>Merchant Name</th>
                <th>Pickup</th>
                <th>Delivery</th>
                <th class="weight-range">0-200g</th>
                <th class="weight-range">200-500g</th>
                <th class="weight-range">500-1000g</th>
                <th class="weight-range">1000-1500g</th>
                <th class="weight-range">1500-2000g</th>
                <th class="weight-range">2000-2500g</th>
                <th class="weight-range">2500+ per kg</th>
                <th>RC</th>
                <th>COD</th>
                <th>Regular order/day</th>
                <th>ACQ By</th>
              </tr>
            </thead>
            <tbody>
              <tr class="title-row">
                <td colspan="15">CarryBee Default Rate</td>
              </tr>
              
              @php
                $rules = $discount->rules;
                
                $weight_ranges = [
                  '0-200' => '49',
                  '201-500' => '60',
                  '501-1000' => '70',
                  '1001-1500' => '80',
                  '1501-2000' => '90',
                  '2001-2500' => '100',
                  '2500+' => '20 TK per kg'
                ];

                $same_city_rules = $rules->where('region', 'same_city')->keyBy('weight_range');
                $same_city_extra = $rules->firstWhere('region', 'same_city');
              @endphp
              
              <tr>
                <td data-label="Merchant ID" rowspan="5">{{ $discount->merchant_id }}</td>
                <td data-label="Merchant Name" rowspan="5">{{ $discount->merchant_name }}</td>
                <td data-label="Pickup">Any Location</td>
                <td data-label="Delivery">Same City</td>
                
                @foreach ($weight_ranges as $range => $default)
                  @if ($same_city_rules->has($range))
                    <td data-label="{{ $range }}g" class="highlight" style="background-color: #ecb90d; color: white;">
                      {{ $same_city_rules[$range]->discounted_rate }}
                    </td>
                  @else
                    <td data-label="{{ $range }}g" class="highlight">
                      {{ $default }}
                    </td>
                  @endif
                @endforeach

                @if ($same_city_extra)
                  <td data-label="RC" style="background-color: #ecb90d; color: white;">
                    {{ $same_city_extra->return_charge }}
                  </td>
                  <td data-label="COD" style="background-color: #ecb90d; color: white;">
                    {{ $same_city_extra->cod }}
                  </td>
                @else
                  <td data-label="RC">0%</td>
                  <td data-label="COD">1%</td>
                @endif
                
                <td data-label="Regular order/day"></td>
                <td data-label="ACQ By"></td>
              </tr>
              
              <!-- DHK Sub City -->
              @php
                $dhk_sub_rules = $rules->where('region', 'dhk_sub')->keyBy('weight_range');
                $dhk_sub_extra = $rules->firstWhere('region', 'dhk_sub');
              @endphp
              <tr>
                <td data-label="Pickup">DHK</td>
                <td data-label="Delivery">Sub City</td>
                @foreach ($weight_ranges as $range => $default)
                  @if ($dhk_sub_rules->has($range))
                    <td data-label="{{ $range }}g" class="highlight" style="background-color: #ecb90d; color: white;">
                      {{ $dhk_sub_rules[$range]->discounted_rate }}
                    </td>
                  @else
                    <td data-label="{{ $range }}g" class="highlight">
                      {{ $default }}
                    </td>
                  @endif
                @endforeach
                @if ($dhk_sub_extra)
                  <td data-label="RC" style="background-color: #ecb90d; color: white;">
                    {{ $dhk_sub_extra->return_charge }}
                  </td>
                  <td data-label="COD" style="background-color: #ecb90d; color: white;">
                    {{ $dhk_sub_extra->cod }}
                  </td>
                @else
                  <td data-label="RC">30%</td>
                  <td data-label="COD">1%</td>
                @endif
                <td data-label="Regular order/day"></td>
                <td data-label="ACQ By"></td>
              </tr>
              
              <!-- DHK Outside City -->
              @php
                $weight_ranges_outside = [
                  '0-200' => '99',
                  '201-500' => '105',
                  '501-1000' => '125',
                  '1001-1500' => '140',
                  '1501-2000' => '150',
                  '2001-2500' => '160',
                  '2500+' => '25 TK per kg'
                ];

                $outside_rules = $rules->where('region', 'dhk_outside')->keyBy('weight_range');
                $outside_extra = $rules->firstWhere('region', 'dhk_outside');
              @endphp
              <tr>
                <td data-label="Pickup">DHK</td>
                <td data-label="Delivery">Outside City</td>
                @foreach ($weight_ranges_outside as $range => $default)
                  @if ($outside_rules->has($range))
                    <td data-label="{{ $range }}g" class="highlight" style="background-color: #ecb90d; color: white;">
                      {{ $outside_rules[$range]->discounted_rate }}
                    </td>
                  @else
                    <td data-label="{{ $range }}g" class="highlight">
                      {{ $default }}
                    </td>
                  @endif
                @endforeach
                @if ($outside_extra)
                  <td data-label="RC" style="background-color: #ecb90d; color: white;">
                    {{ $outside_extra->return_charge }}
                  </td>
                  <td data-label="COD" style="background-color: #ecb90d; color: white;">
                    {{ $outside_extra->cod }}
                  </td>
                @else
                  <td data-label="RC">30%</td>
                  <td data-label="COD">1%</td>
                @endif
                <td data-label="Regular order/day"></td>
                <td data-label="ACQ By"></td>
              </tr>

              <!-- Outside DHK to DHK -->
              @php
                $weight_ranges_outside_dhk = [
                  '0-200' => '99',
                  '201-500' => '105',
                  '501-1000' => '110',
                  '1001-1500' => '125',
                  '1501-2000' => '125',
                  '2001-2500' => '150',
                  '2500+' => '25 TK per kg'
                ];

                $outside_dhk_rules = $rules->where('region', 'outside_dhk')->keyBy('weight_range');
                $outside_dhk_extra = $rules->firstWhere('region', 'outside_dhk');
              @endphp
              <tr>
                <td data-label="Pickup">Outside DHK</td>
                <td data-label="Delivery">DHK</td>
                @foreach ($weight_ranges_outside_dhk as $range => $default)
                  @if ($outside_dhk_rules->has($range))
                    <td data-label="{{ $range }}g" class="highlight" style="background-color: #ecb90d; color: white;">
                      {{ $outside_dhk_rules[$range]->discounted_rate }}
                    </td>
                  @else
                    <td data-label="{{ $range }}g" class="highlight">
                      {{ $default }}
                    </td>
                  @endif
                @endforeach
                @if ($outside_dhk_extra)
                  <td data-label="RC" style="background-color: #ecb90d; color: white;">
                    {{ $outside_dhk_extra->return_charge }}
                  </td>
                  <td data-label="COD" style="background-color: #ecb90d; color: white;">
                    {{ $outside_dhk_extra->cod }}
                  </td>
                @else
                  <td data-label="RC">30%</td>
                  <td data-label="COD">1%</td>
                @endif
                <td data-label="Regular order/day"></td>
                <td data-label="ACQ By"></td>
              </tr>

              <!-- Outside DHK to Outside DHK -->
              @php
                $weight_ranges_outside_outside = [
                  '0-200' => '125',
                  '201-500' => '125',
                  '501-1000' => '135',
                  '1001-1500' => '145',
                  '1501-2000' => '155',
                  '2001-2500' => '165',
                  '2500+' => '25 TK per kg'
                ];

                $outside_outside_rules = $rules->where('region', 'outside_outside')->keyBy('weight_range');
                $outside_outside_extra = $rules->firstWhere('region', 'outside_outside');
              @endphp
              <tr>
                <td data-label="Pickup">Outside DHK</td>
                <td data-label="Delivery">Outside DHK</td>
                @foreach ($weight_ranges_outside_outside as $range => $default)
                  @if ($outside_outside_rules->has($range))
                    <td data-label="{{ $range }}g" class="highlight" style="background-color: #ecb90d; color: white;">
                      {{ $outside_outside_rules[$range]->discounted_rate }}
                    </td>
                  @else
                    <td data-label="{{ $range }}g" class="highlight">
                      {{ $default }}
                    </td>
                  @endif
                @endforeach
                @if ($outside_outside_extra)
                  <td data-label="RC" style="background-color: #ecb90d; color: white;">
                    {{ $outside_outside_extra->return_charge }}
                  </td>
                  <td data-label="COD" style="background-color: #ecb90d; color: white;">
                    {{ $outside_outside_extra->cod }}
                  </td>
                @else
                  <td data-label="RC">30%</td>
                  <td data-label="COD">1%</td>
                @endif
                <td data-label="Regular order/day"></td>
                <td data-label="ACQ By"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      @endforeach
    @endif
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  
  <script>
    document.querySelector('.export-all-btn').addEventListener('click', () => {
      let csv = [];
      let merchants = document.querySelectorAll('.merchant-section');
      
      merchants.forEach((merchant, index) => {
        let merchantName = merchant.querySelector('h3').innerText.trim();
        let table = merchant.querySelector('table');
        if (!table) return;

        // Add Merchant name as a header row before table data
        csv.push(`"${merchantName} Rates"`);
        
        // Get table rows
        const rows = table.querySelectorAll('tr');
        rows.forEach(row => {
          let cols = row.querySelectorAll('th, td');
          let rowData = [];
          cols.forEach(col => {
            let text = col.innerText.replace(/\n/g, ' ').trim().replace(/"/g, '""');
            rowData.push(`"${text}"`);
          });
          csv.push(rowData.join(','));
        });

        // Add 2 blank lines between merchants except after last one
        if (index !== merchants.length - 1) {
          csv.push('');
          csv.push('');
        }
      });

      const csvContent = csv.join('\n');
      const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);

      const a = document.createElement('a');
      a.setAttribute('href', url);
      a.setAttribute('download', 'carrybee_all_merchants_rates.csv');
      a.style.display = 'none';

      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      URL.revokeObjectURL(url);
    });
  </script>
</body>
</html>
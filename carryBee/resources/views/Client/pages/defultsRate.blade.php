@if(request()->is('default-rate'))
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CarryBee Default Rate</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #ecb90d;
      --secondary-color: #ecb90d;
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
        <i class="fas fa-truck me-2" style="color: var(--primary-color);"></i>CarryBee 
      </h2>
    </div>
    
    <div class="table-container">
      <table class="table table-borde#ecb90d">
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
            <td colspan="15"></td>
          </tr>
          <tr>
            <td data-label="Merchant ID" rowspan="5">-</td>
            <td data-label="Merchant Name" rowspan="5">-</td>
            <td data-label="Pickup">Any Location</td>
            <td data-label="Delivery">Same City</td>
            <td data-label="0-200g" class="highlight">49</td>
            <td data-label="200-500g" class="highlight">60</td>
            <td data-label="500-1000g" class="highlight">70</td>
            <td data-label="1000-1500g" class="highlight">80</td>
            <td data-label="1500-2000g" class="highlight">90</td>
            <td data-label="2000-2500g" class="highlight">100</td>
            <td data-label="2500+ per kg">20 TK per kg</td>
            <td data-label="RC">0%</td>
            <td data-label="COD">1%</td>
            <td data-label="Regular order/day"></td>
            <td data-label="ACQ By"></td>
          </tr>
          <tr>
            <td data-label="Pickup">DHK</td>
            <td data-label="Delivery">Sub City</td>
            <td data-label="0-200g" class="highlight">80</td>
            <td data-label="200-500g" class="highlight">85</td>
            <td data-label="500-1000g" class="highlight">100</td>
            <td data-label="1000-1500g" class="highlight">120</td>
            <td data-label="1500-2000g" class="highlight">125</td>
            <td data-label="2000-2500g" class="highlight">135</td>
            <td data-label="2500+ per kg">20 TK per kg</td>
            <td data-label="RC">30%</td>
            <td data-label="COD">1%</td>
            <td data-label="Regular order/day"></td>
            <td data-label="ACQ By"></td>
          </tr>
          <tr>
            <td data-label="Pickup">DHK</td>
            <td data-label="Delivery">Outside City</td>
            <td data-label="0-200g" class="highlight">99</td>
            <td data-label="200-500g" class="highlight">105</td>
            <td data-label="500-1000g" class="highlight">125</td>
            <td data-label="1000-1500g" class="highlight">140</td>
            <td data-label="1500-2000g" class="highlight">150</td>
            <td data-label="2000-2500g" class="highlight">160</td>
            <td data-label="2500+ per kg">25 TK per kg</td>
            <td data-label="RC">30%</td>
            <td data-label="COD">1%</td>
            <td data-label="Regular order/day"></td>
            <td data-label="ACQ By"></td>
          </tr>
          <tr>
            <td data-label="Pickup">Outside DHK</td>
            <td data-label="Delivery">DHK</td>
            <td data-label="0-200g" class="highlight">99</td>
            <td data-label="200-500g" class="highlight">105</td>
            <td data-label="500-1000g" class="highlight">110</td>
            <td data-label="1000-1500g" class="highlight">125</td>
            <td data-label="1500-2000g" class="highlight">125</td>
            <td data-label="2000-2500g" class="highlight">150</td>
            <td data-label="2500+ per kg">25 TK per kg</td>
            <td data-label="RC">30%</td>
            <td data-label="COD">1%</td>
            <td data-label="Regular order/day"></td>
            <td data-label="ACQ By"></td>
          </tr>
          <tr>
            <td data-label="Pickup">Outside DHK</td>
            <td data-label="Delivery">Outside DHK</td>
            <td data-label="0-200g" class="highlight">125</td>
            <td data-label="200-500g" class="highlight">125</td>
            <td data-label="500-1000g" class="highlight">135</td>
            <td data-label="1000-1500g" class="highlight">145</td>
            <td data-label="1500-2000g" class="highlight">155</td>
            <td data-label="2000-2500g" class="highlight">165</td>
            <td data-label="2500+ per kg">25 TK per kg</td>
            <td data-label="RC">30%</td>
            <td data-label="COD">1%</td>
            <td data-label="Regular order/day"></td>
            <td data-label="ACQ By"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


@else





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CarryBee Default Rate</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #ecb90d;
      --secondary-color: #ecb90d;
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
    }
    
    .table {
      margin-bottom: 0;
    }
    
    .table thead th {
      background-color: #ecb90d;
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
        <i class="fas fa-truck me-2" style="color: var(--primary-color);"></i>CarryBee
      </h2>
    </div>
  <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-store me-2 text-primary"></i>Merchant Information
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
        <br>
    
    
    <div class="table-container">
   
      <table class="table table-borde: #ecb90d">
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
    
            <th>ACQ By</th>
          </tr>
        </thead>
        <tbody>
          
          <tr class="title-row">
         
          </tr>
          <tr>
          
            <td data-label="Merchant ID" rowspan="5">{{ $discount->merchant_id }}</td>
            <td data-label="Merchant Name" rowspan="5">{{ $discount->merchant_name }}</td>
            <td data-label="Pickup">Any Location</td>
            <td data-label="Delivery">Same City</td>
             @php
  $weight_ranges = [
    '0-200' => '49',
    '201-500' => '60',
    '501-1000' => '70',
    '1001-1500' => '80',
    '1501-2000' => '90',
    '2001-2500' => '100',
    '2500+' => '20 TK per kg'
  ];

  $same_city_rules = collect($rules)->where('region', 'same_city')->keyBy('weight_range');
  $same_city_extra = collect($rules)->firstWhere('region', 'same_city');
@endphp

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

           
           
          <td data-label="Merchant ID" rowspan="5">{{ $discount->kma }}</td>
           
          </tr>
          <tr>
            <td data-label="Pickup">DHK</td>
            <td data-label="Delivery">Sub City</td>
              @php
  $weight_ranges = [
    '0-200' => '80',
    '201-500' => '85',
    '501-1000' => '100',
    '1001-1500' => '120',
    '1501-2000' => '125',
    '2001-2500' => '135',
    '2500+' => '20 TK per kg'
  ];

  $dhk_sub_rules = collect($rules)->where('region', 'dhk_sub')->keyBy('weight_range');
  $dhk_sub_extra = collect($rules)->firstWhere('region', 'dhk_sub');
@endphp

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
       
          
           
          </tr>
          <tr>
            <td data-label="Pickup">DHK</td>
            <td data-label="Delivery">Outside City</td>
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

  $outside_rules = collect($rules)->where('region', 'dhk_outside')->keyBy('weight_range');
  $outside_extra = collect($rules)->firstWhere('region', 'dhk_outside');
@endphp

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

          
           
          </tr>
          <tr>
          <td data-label="Pickup">Outside DHK</td>
            <td data-label="Delivery">DHK</td>
         
                @php
  $weight_ranges = [
    '0-200' => '99',
    '201-500' => '105',
    '501-1000' => '110',
    '1001-1500' => '125',
    '1501-2000' => '125',
    '2001-2500' => '150',
    '2500+' => '25 TK per kg'
  ];

  $outside_dhk_rules = collect($rules)->where('region', 'outside_dhk')->keyBy('weight_range');
  $outside_dhk_extra = collect($rules)->firstWhere('region', 'outside_dhk');
@endphp

@foreach ($weight_ranges as $range => $default)
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
      
           
          </tr>
          <tr>
            <td data-label="Pickup">Outside DHK</td>
            <td data-label="Delivery">Outside DHK</td>
           @php
  $weight_ranges = [
    '0-200' => '125',
    '201-500' => '125',
    '501-1000' => '135',
    '1001-1500' => '145',
    '1501-2000' => '155',
    '2001-2500' => '165',
    '2500+' => '25 TK per kg'
  ];

  $outside_outside_rules = collect($rules)->where('region', 'outside_outside')->keyBy('weight_range');
  $outside_outside_extra = collect($rules)->firstWhere('region', 'outside_outside');
@endphp

@foreach ($weight_ranges as $range => $default)
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
         
           
          </tr>
          
        </tbody>
      </table>
     
    </div>
  </div>

  <!-- Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endif
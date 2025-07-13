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
        <i class="fas fa-truck me-2" style="color: var(--primary-color);"></i>CarryBee Default Rate
      </h2>
    </div>
    
    <div class="table-container">
      <table class="table table-bordered">
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
@extends('admin.layout.masterlayout')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h4 class="mb-2 mb-md-0">Pending Approvals</h4>
        <div class="d-flex align-items-center gap-2">
            <!-- Search input -->
             
            <input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search merchants...">
            <a href="{{ route('AllRules') }}" class="btn btn-secondary btn-sm">
                      <i class="fas fa-list-check me-1"></i> <span class="d-none d-sm-inline">View All Rules</span>
                    </a>
            <button class="btn btn-success" id="exportTableBtn"><i class="fa fa-download"></i> Export CSV</button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="approvalTable" class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Merchant</th>
                    <th>Category & Burn Details</th>
                    <th>Location & Revenue</th>
                    <th>Promised Volume</th>
                    <th>Discount Slots</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             @foreach($merchants as $merchant)
    @php
        $discount = $groupedDiscounts[$merchant->id] ?? [];
        $parcelCount = $merchant->promised_parcels;
        $monthlyParcels = $parcelCount * 30;
        $minBurn = $parcelCount * 60;

        $regionWiseDetails = [];
        $totalBurn = 0;
        $totalRevenue = 0;
        $burnRecords = [];

        foreach (($discount ?? []) as $region => $weights) {
            foreach ($weights as $weightRange => $rule) {
                $defaultRate = $defaultRates[$region][$weightRange] ?? 0;
                $discountedRate = $rule->discounted_rate ?? $defaultRate;

                $burnPerParcel = $discountedRate - $defaultRate;
                $revenuePerParcel = $discountedRate;

                $burn = $burnPerParcel * $parcelCount;
                $revenue = $revenuePerParcel * $parcelCount;

                $totalBurn += $burn;
                $totalRevenue += $revenue;

                $regionWiseDetails[] = [
                    'region' => $region,
                    'weightRange' => $weightRange,
                    'defaultRate' => $defaultRate,
                    'discountedRate' => $discountedRate,
                    'dailyRevenue' => $revenue,
                    'dailyBurn' => $burn,
                    'monthlyRevenue' => $revenue * 30,
                    'monthlyBurn' => $burn * 30,
                    'avgRevenue' => '-',
                    'avgBurn' => '-',
                  
                ];

                $burnRecords[] = [
                    'burnPerParcel' => $burnPerParcel,
                    'revenuePerParcel' => $revenuePerParcel,
                ];
            }
        }

        $aggMonthlyRevenue = $totalRevenue * 30;
        $aggMonthlyBurn = $totalBurn * 30;

        $maxBurnValue = collect($burnRecords)->sortBy('burnPerParcel')->first()['burnPerParcel'] ?? 0;
        $maxBurnMatches = collect($burnRecords)->where('burnPerParcel', $maxBurnValue);
        $maxBurn = $maxBurnValue * $parcelCount;

        if ($maxBurnMatches->count() > 1) {
            $revenues = $maxBurnMatches->pluck('revenuePerParcel');
            $maxRevenue = $revenues->max() * $parcelCount;
            $minRevenue = $revenues->min() * $parcelCount;
        } else {
            $revenuePerParcel = $maxBurnMatches->first()['revenuePerParcel'] ?? 0;
            $maxRevenue = $revenuePerParcel * $parcelCount;
            $minRevenue = $maxRevenue;
        }

        
        $topBurn1 = collect($burnRecords)->sortBy('burnPerParcel')->first()['burnPerParcel'] ?? 0;
        $topBurn2 = collect($burnRecords)->sortBy('burnPerParcel')->skip(1)->first()['burnPerParcel'] ?? 0;
          $lowestBurn_fixed = collect($burnRecords)->sortByDesc('burnPerParcel')->first()['burnPerParcel'] ?? 0;

        if(0 <= $lowestBurn_fixed) {
            $lowestBurn = 0;
        } else {
            $lowestBurn = collect($burnRecords)->sortByDesc('burnPerParcel')->skip(1)->first()['burnPerParcel'] ?? 0;
        }

        $topRevenue1 = collect($burnRecords)->where('burnPerParcel', $topBurn1)->pluck('revenuePerParcel')->max() ?? 0;
        $topRevenue2 = collect($burnRecords)->where('burnPerParcel', $lowestBurn)->pluck('revenuePerParcel')->max() ?? 0;

        $parcel60 = ($parcelCount * 60) / 100;
        $parcel40 = ($parcelCount * 40) / 100;

        $avgRevenue = ((($topRevenue1 * $parcel60) + ($topRevenue2 * $parcel40)) / 2)*30;
        $avgBurn = ((($topBurn1 * $parcel60) + ($lowestBurn * $parcel40)) / 2)*30;

        $avgRevenueD = (($topRevenue1 * $parcel60) + ($topRevenue2 * $parcel40)) / 2;
        $avgBurnD = (($topBurn1 * $parcel60) + ($lowestBurn * $parcel40)) / 2;

        $regionWiseDetails[] = [
             'region' => 'Average',
                        'weightRange' => '-',
                        'defaultRate' => '-',
                        'discountedRate' => '-',
                        'dailyRevenue' => '-',
                        'dailyBurn' => '-',
                        'monthlyRevenue' => '-',
                        'monthlyBurn' =>  '-',
                        'avgRevenue' => number_format($avgRevenue, 2),
                        'avgBurn' => number_format($avgBurn, 2),
        ];

                @endphp
                <tr>
                    <td class="text-start">
                        <strong>{{ $merchant->merchant_name }}</strong><br>
                        <small class="text-muted">#{{ $merchant->merchant_id }}</small><br>
                        <small class="text-muted">-{{ $merchant->kma }}</small>
                    </td>
                    <td class="text-start">
                        <strong>{{ ucfirst($merchant->product_category) }}</strong><br>
                        <small>
                        
                            <u><strong>Max Burn & Revenue</strong></u><br>
                            Daily Burn: ৳{{ number_format($maxBurn) }}<br>
                            Max Revenue: ৳{{ number_format($maxRevenue) }}<br>
                            Min Revenue: ৳{{ number_format($minRevenue) }}<br>
                            <button class="btn btn-sm btn-link text-primary" onclick='showBreakdown(@json($regionWiseDetails))'>Show Breakdown</button>
                        </small>
                    </td>
                    <td class="text-start">
                        <strong>{{ $merchant->pickup_hub }}</strong><br>
                        <small>AVG Revenue(Daily): ৳{{ number_format($avgRevenueD) }}</small><br>
                        <small>AVG Burn(Daily): ৳{{ number_format($avgBurnD) }}</small><br>
                        <small>AVG Revenue(Monthly): ৳{{ number_format($avgRevenue) }}</small><br>
                        <small>AVG Burn(Monthly): ৳{{ number_format($avgBurn) }}</small>
                    </td>
                    <td>
                        <strong>{{ $parcelCount }}/day</strong><br>
                        <small>{{ number_format($monthlyParcels) }}/month</small>
                    </td>
                   <td>
                    <a href="{{ route('DiscountSlot', $merchant->id) }}" class="btn btn-secondary btn-sm">
                      <i class="fas fa-list-check me-1"></i> <span class="d-none d-sm-inline">View Rules</span>
                    </a>
                   </td>
                   @if($merchant->is_active == 0)
                   <td><span class="badge bg-warning text-dark">Upon Discussion</span></td>
                   @elseif($merchant->is_active == 1)
                    <td><span class="badge bg-success">Approved</span></td> 
                     @else
                    <td><span class="badge bg-danger">Rejected</span></td>
                   @endif
                    
               
  <td>
    <!-- Approve -->
    <form action="{{ route('merchant.approve', $merchant->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-success me-1" onclick="return confirm('Are you sure you want to APPROVE this merchant?')">
            <i class="fa fa-check"></i>
        </button>
    </form>

    <!-- Reject -->
    <form action="{{ route('merchant.reject', $merchant->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-danger me-1" onclick="return confirm('Are you sure you want to REJECT this merchant?')">
            <i class="fa fa-times"></i>
        </button>
    </form>

    <!-- Ban -->
    <form action="{{ route('merchant.ban', $merchant->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-warning" onclick="return confirm('Are you sure you want to BAN this merchant?')">
            <i class="fa fa-ban"></i>
        </button>
    </form>
</td>



                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Breakdown Modal -->
<div class="modal fade" id="breakdownModal" tabindex="-1" aria-labelledby="breakdownModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Breakdown Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search region or weight...">
        <button class="btn btn-success mb-2" onclick="exportBreakdownToCSV()">Export CSV</button>
        <div class="table-responsive">
          <table class="table table-bordered" id="breakdownTable">
            <thead class="table-light">
              <tr>
                <th>Region</th>
                <th>Weight Range</th>
                <th>Default Rate</th>
                <th>Discounted Rate</th>
                <th>Daily Revenue</th>
                <th>Daily Burn</th>
                <th>Monthly Revenue</th>
                <th>Monthly Burn</th>
                <th>AVG Revenue</th>
                <th>AVG Burn</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>


document.querySelectorAll('.action-btn').forEach(button => {
    button.addEventListener('click', function() {
        const merchantId = this.dataset.id;
        const action = this.dataset.action;

        let confirmMsg = '';
        if(action === 'approve') confirmMsg = 'Are you sure you want to APPROVE this merchant?';
        else if(action === 'reject') confirmMsg = 'Are you sure you want to REJECT this merchant?';
        else if(action === 'ban') confirmMsg = 'Are you sure you want to BAN this merchant?';

        if(!confirm(confirmMsg)) return;

        fetch(`/merchant/${merchantId}/${action}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if(response.ok) return response.json();
            throw new Error('Network response was not ok.');
        })
        .then(data => {
            alert(data.message || 'Action completed successfully!');
            // Optionally, remove or update the merchant row
            // For example, reload page:
            location.reload();
        })
        .catch(error => {
            alert('There was an error: ' + error.message);
        });
    });
});


  document.getElementById('tableSearch').addEventListener('input', function () {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#approvalTable tbody tr');

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            row.style.display = rowText.includes(searchValue) ? '' : 'none';
        });
    });

    function formatCurrency(value) {
        return value.toString().replace(/[৳à§³]/g, '').trim();
    }

    function showBreakdown(data) {
        const tbody = document.querySelector('#breakdownTable tbody');
        tbody.innerHTML = '';

        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.region}</td>
                <td>${row.weightRange}</td>
                <td>৳${row.defaultRate}</td>
                <td>৳${row.discountedRate}</td>
                <td>৳${row.dailyRevenue}</td>
                <td>৳${row.dailyBurn}</td>
                <td>৳${row.monthlyRevenue}</td>
                <td>৳${row.monthlyBurn}</td>
                <td>৳${row.avgRevenue}</td>
                <td>৳${row.avgBurn}</td>
            `;
            tbody.appendChild(tr);
        });

        const modal = new bootstrap.Modal(document.getElementById('breakdownModal'));
        modal.show();
    }

    document.getElementById('exportTableBtn').addEventListener('click', () => {
        const table = document.getElementById('approvalTable');
        const headers = [
            'Merchant Name', 'Merchant ID', 'Category', 
            'Min Burn Daily (BDT)', 'Max Burn Daily (BDT)',
            'Max Revenue Daily (BDT)', 'Min Revenue Daily (BDT)',
            'Location', 'Total Revenue Daily (BDT)',
            'Parcels Daily', 'Parcels Monthly', 'Status'
        ];

        const rows = [];

        table.querySelectorAll('tbody tr').forEach(tr => {
            if (tr.style.display === 'none') return;
            const cols = Array.from(tr.querySelectorAll('td'));
            const rowData = [];

            const merchantCol = cols[0].innerText.split('\n');
            rowData.push(
                merchantCol[0].trim(),
                merchantCol[1] ? merchantCol[1].replace('#', '').trim() : ''
            );

            const categoryCol = cols[1].innerText.split('\n');
            rowData.push(
                categoryCol[0].trim(),
                formatCurrency(categoryCol.find(t => t.includes('Daily:')) || '0'),
                formatCurrency(categoryCol.find(t => t.includes('Daily Burn:')) || '0'),
                formatCurrency(categoryCol.find(t => t.includes('Max Revenue:')) || '0'),
                formatCurrency(categoryCol.find(t => t.includes('Min Revenue:')) || '0')
            );

            const locationCol = cols[2].innerText.split('\n');
            rowData.push(
                locationCol[0].trim(),
                formatCurrency(locationCol.find(t => t.includes('Total Revenue:')) || '0')
            );

            const volumeCol = cols[3].innerText.split('\n');
            rowData.push(
                volumeCol[0].replace('/day', '').trim(),
                volumeCol[1] ? volumeCol[1].replace('/month', '').trim() : ''
            );

            rowData.push(cols[4].innerText.trim());
            rows.push(rowData);
        });

        let csvContent = "\uFEFF" + headers.join(',') + '\n';
        rows.forEach(row => {
            csvContent += row.map(item => `"${item}"`).join(',') + '\n';
        });

        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'merchant_approvals.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    function exportBreakdownToCSV() {
        const table = document.getElementById('breakdownTable');
        const headers = Array.from(table.querySelectorAll('thead th')).map(th => 
            th.innerText.trim().includes('Rate') || th.innerText.trim().includes('Revenue') || th.innerText.trim().includes('Burn') ? 
            `${th.innerText.trim()} (BDT)` : 
            th.innerText.trim()
        );

        const rows = [];
        table.querySelectorAll('tbody tr').forEach(tr => {
            rows.push(Array.from(tr.querySelectorAll('td')).map(td => 
                formatCurrency(td.innerText.trim())
            ));
        });

        let csvContent = "\uFEFF" + headers.join(',') + '\n';
        rows.forEach(row => {
            csvContent += row.join(',') + '\n';
        });

        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'breakdown_details.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
@endpush
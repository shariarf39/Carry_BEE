@extends('admin.layout.masterlayout')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h4 class="mb-2 mb-md-0">Pending Approvals</h4>
        <div class="d-flex">
            <button class="btn btn-outline-secondary me-2"><i class="fa fa-refresh"></i> Refresh</button>
            <button class="btn btn-primary"><i class="fa fa-check-circle"></i> Batch Approve</button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
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
                    $isd = $discount['same_city']['0-200']->discounted_rate ?? $defaultRates['same_city']['0-200'];
                    $osd = $discount['dhk_outside']['0-200']->discounted_rate ?? $defaultRates['dhk_outside']['0-200'];
                    $baseDiscount = $merchant->base_discount ?? 10;
                    $cod = $discount['same_city']['0-200']->cod ?? 20;
                    $rc = $discount['same_city']['0-200']->return_charge ?? 50;
                    $dailyParcels = $merchant->promised_parcels;
                    $monthlyParcels = $dailyParcels * 30;
                    $dailyRevenue = $dailyParcels * 300;
                    $monthlyRevenue = $dailyRevenue * 30;
                    $dailyMaxBurn = $dailyParcels * 100;
                    $monthlyMaxBurn = $dailyMaxBurn * 30;
                    $minBurn = $dailyParcels * 60;
                @endphp
                <tr>
                  
                    <td class="text-start">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-light text-primary fw-bold text-uppercase d-flex justify-content-center align-items-center me-2" style="width: 40px; height: 40px;">
                                {{ substr($merchant->merchant_name, 0, 2) }}
                            </div>
                            <div>
                                <strong>{{ $merchant->merchant_name }}</strong><br>
                                <small class="text-muted">#{{ $merchant->merchant_id }}</small>
                            </div>
                        </div>
                    </td>
                    <td class="text-start">
                        <strong>{{ ucfirst($merchant->product_category) }}</strong><br>
                        <small>
                            Daily Max Burn: ৳{{ number_format($dailyMaxBurn) }}<br>
                            Monthly Max Burn: ৳{{ number_format($monthlyMaxBurn) }}<br>
                            Min Burn: ৳{{ number_format($minBurn) }}<br><br>
                            Daily Revenue: ৳{{ number_format($dailyRevenue) }}<br>
                            Monthly Revenue: ৳{{ number_format($monthlyRevenue) }}
                        </small>
                    </td>
                    <td class="text-start">
                        <strong>{{ $merchant->pickup_hub }}</strong><br>
                        <small>Revenue: ৳{{ number_format($dailyRevenue) }}</small>
                    </td>
                    <td>
                        <strong>{{ $dailyParcels }}/day</strong><br>
                        <small>{{ number_format($monthlyParcels) }}/month</small>
                    </td>
                    <td class="text-start">
                        <small>
                            ISD to OSD: {{ $isd }}৳<br>
                            OSD to OSD: {{ $osd }}৳<br>
                            Base Discount: {{ $baseDiscount }}%<br>
                            COD Charge: {{ $cod }}৳<br>
                            Return Charge: {{ $rc }}৳
                        </small>
                    </td>
                    <td>
                        <span class="badge bg-warning text-dark">Pending</span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-success me-1"><i class="fa fa-check"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-danger"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

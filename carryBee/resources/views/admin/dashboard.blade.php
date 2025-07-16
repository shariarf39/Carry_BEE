@extends('admin.layout.masterlayout')

@section('content')

@php
    // Initialize variables to hold aggregate data
    $totalRevenueAll = 0;
    $totalBurnAll = 0; 
    $chartLabels = [];
    $revenueData = [];
    $lossData = [];

    foreach ($merchants as $merchant) {
        $merchantRevenue = 0;
        $merchantBurn = 0;
        $monthlyParcelCount = $merchant->promised_parcels * 30;
        $discountRules = $groupedDiscounts[$merchant->id] ?? [];

        $totalDefaultRate = 0;
        $totalDiscountedRate = 0;
        $ruleCount = 0;

        if (!empty($discountRules)) {
            foreach ($discountRules as $region => $weights) {
                foreach ($weights as $weightRange => $rule) {
                    $defaultRate = $defaultRates[$region][$weightRange] ?? 0;
                    $discountedRate = $rule->discounted_rate ?? $defaultRate;
                    $totalDefaultRate += $defaultRate;
                    $totalDiscountedRate += $discountedRate;
                    $ruleCount++;
                }
            }
        }

        if ($ruleCount == 0 && !empty($defaultRates)) {
            $totalDefaultRateForAll = 0;
            $allRulesCount = 0;
            foreach($defaultRates as $region => $weights) {
                foreach($weights as $weight => $rate) {
                    $totalDefaultRateForAll += $rate;
                    $allRulesCount++;
                }
            }
            $averageDefaultRate = ($allRulesCount > 0) ? $totalDefaultRateForAll / $allRulesCount : 0;
            $averageDiscountedRate = $averageDefaultRate;
        } else {
            $averageDefaultRate = ($ruleCount > 0) ? $totalDefaultRate / $ruleCount : 0;
            $averageDiscountedRate = ($ruleCount > 0) ? $totalDiscountedRate / $ruleCount : 0;
        }

        $merchantRevenue = $averageDiscountedRate * $monthlyParcelCount;
        $merchantBurn = ($averageDefaultRate - $averageDiscountedRate) * $monthlyParcelCount;
        $totalRevenueAll += $merchantRevenue;
        $totalBurnAll += $merchantBurn;

        $chartLabels[] = $merchant->name;
        $revenueData[] = round($merchantRevenue, 2);
        $lossData[] = round($merchantBurn, 2);
    }
    $totalDiscounts = $totalBurnAll;
    $userChangePercentage = 5.2; 
@endphp

<div class="container py-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Projected Burn</p>
                    <h3 class="text-2xl font-bold mt-1">৳{{ number_format($totalDiscounts, 2) }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-red-500 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-down mr-1 text-xs"></i>
                            {{ $totalRevenueAll > 0 ? number_format(($totalDiscounts / $totalRevenueAll) * 100, 2) : 0 }}%
                        </span>
                        <span class="text-gray-500 text-xs ml-2">of revenue</span>
                    </div>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i class="fas fa-tags text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Merchants</p>
                    <h3 class="text-2xl font-bold mt-1">{{ number_format($totalUsers) }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="{{ $userChangePercentage >= 0 ? 'text-green-500' : 'text-red-500' }} text-sm font-medium flex items-center">
                            <i class="fas {{ $userChangePercentage >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1 text-xs"></i>
                            {{ number_format($userChangePercentage, 1) }}%
                        </span>
                        <span class="text-gray-500 text-xs ml-2">last month</span>
                    </div>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Projected Revenue</p>
                    <h3 class="text-2xl font-bold mt-1">৳{{ number_format($totalRevenueAll, 2) }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i>
                            Monthly Projection
                        </span>
                        <span class="text-gray-500 text-xs ml-2">after discounts</span>
                    </div>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-red-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Admin</p>
                    <h3 class="text-2xl font-bold mt-1">{{ number_format($totalAdmin) }}</h3>
                </div>
                <div class="bg-red-100 p-3 rounded-lg">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-5 mt-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Merchant Revenue & Burn Analytics (Monthly Projection)</h2>
        </div>
        <div class="h-80">
            <canvas id="discountsChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('discountsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [
                    {
                        label: 'Projected Revenue',
                        data: {!! json_encode($revenueData) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Projected Burn (Discount)',
                        data: {!! json_encode($lossData) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { color: '#6b7280' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6', drawBorder: false },
                        ticks: {
                            color: '#6b7280',
                            callback: function(value) {
                                return '৳' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                if (context.parsed.y !== null) {
                                    label += '৳' + context.parsed.y.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                                }
                                return label;
                            }
                        }
                    },
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    });
</script>
@endpush

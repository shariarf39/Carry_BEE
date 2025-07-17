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

<div class="container mx-auto px-4 py-6">
    <!-- Dashboard Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Discount Analytics Dashboard</h1>
            <p class="text-gray-600">Monthly projections and performance metrics</p>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">Last updated: {{ now()->format('M d, Y h:i A') }}</span>
            <button class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-sm">
                <i class="fas fa-sync-alt mr-1"></i> Refresh
            </button>
        </div>
    </div>

    <!-- Key Metrics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Burn Rate Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Projected Burn</p>
                        <h3 class="text-2xl font-bold mt-1 text-gray-800">৳{{ formatCompactNumber($totalDiscounts, 2) }}</h3>
                    </div>
                    <div class="bg-red-50 p-3 rounded-full">
                        <i class="fas fa-fire text-red-500 text-lg"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">% of revenue</span>
                        <span class="font-medium text-red-600">
                            {{ $totalRevenueAll > 0 ? formatCompactNumber(($totalDiscounts / $totalRevenueAll) * 100, 2) : 0 }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                        <div class="bg-red-500 h-2 rounded-full" 
                             style="width: {{ $totalRevenueAll > 0 ? min(($totalDiscounts / $totalRevenueAll) * 100, 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Merchants Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Merchants</p>
                        <h3 class="text-2xl font-bold mt-1 text-gray-800">{{ formatCompactNumber($totalUsers) }}</h3>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-full">
                        <i class="fas fa-users text-blue-500 text-lg"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Monthly change</span>
                        <span class="font-medium {{ $userChangePercentage >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            <i class="fas {{ $userChangePercentage >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                            {{ formatCompactNumber($userChangePercentage, 1) }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Projected Revenue</p>
                        <h3 class="text-2xl font-bold mt-1 text-gray-800">৳{{ formatCompactNumber($totalRevenueAll, 2) }}</h3>
                    </div>
                    <div class="bg-green-50 p-3 rounded-full">
                        <i class="fas fa-chart-line text-green-500 text-lg"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">After discounts</span>
                        <span class="font-medium text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i> Monthly
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 65%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">System Admins</p>
                        <h3 class="text-2xl font-bold mt-1 text-gray-800">{{ formatCompactNumber($totalAdmin) }}</h3>
                    </div>
                    <div class="bg-purple-50 p-3 rounded-full">
                        <i class="fas fa-user-shield text-purple-500 text-lg"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Active sessions</span>
                        <span class="font-medium text-gray-600">12</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: 40%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Chart Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="border-b border-gray-200 px-5 py-4">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-gray-800">Merchant Revenue & Burn Analysis</h2>
                <div class="flex space-x-2">
                    <select class="text-sm border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Monthly</option>
                        <option>Quarterly</option>
                        <option>Yearly</option>
                    </select>
                    <button class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="h-96">
                <canvas id="discountsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Secondary Metrics Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <!-- Burn Rate Distribution -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-medium text-gray-800">Burn Rate Distribution</h3>
                <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded">This Month</span>
            </div>
            <div class="h-64">
                <canvas id="burnDistributionChart"></canvas>
            </div>
        </div>

        <!-- Top Merchants by Discount -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-medium text-gray-800">Top Merchants by Discount</h3>
                <span class="text-xs bg-green-50 text-green-600 px-2 py-1 rounded">Top 5</span>
            </div>
            <div class="space-y-4">
                @foreach(array_slice(array_combine($chartLabels, $lossData), 0, 5) as $merchant => $loss)
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center">
                            <span class="text-blue-600 text-xs font-bold">{{ $loop->iteration }}</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 truncate" style="max-width: 120px;">{{ $merchant }}</span>
                    </div>
                    <span class="text-sm font-semibold text-red-600">৳{{ formatCompactNumber($loss, 2) }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-medium text-gray-800">Recent Discount Updates</h3>
                <span class="text-xs bg-purple-50 text-purple-600 px-2 py-1 rounded">Latest</span>
            </div>
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="bg-yellow-50 p-2 rounded-full">
                        <i class="fas fa-tags text-yellow-500 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">New discount rules applied</p>
                        <p class="text-xs text-gray-500">2 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="bg-green-50 p-2 rounded-full">
                        <i class="fas fa-user-edit text-green-500 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Merchant rate updated</p>
                        <p class="text-xs text-gray-500">Yesterday</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="bg-blue-50 p-2 rounded-full">
                        <i class="fas fa-file-import text-blue-500 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Bulk discounts imported</p>
                        <p class="text-xs text-gray-500">Jul 12, 2023</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Main Bar Chart
        const ctx = document.getElementById('discountsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [
                    {
                        label: 'Projected Revenue',
                        data: {!! json_encode($revenueData) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                        barPercentage: 0.7
                    },
                    {
                        label: 'Projected Burn',
                        data: {!! json_encode($lossData) !!},
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                        barPercentage: 0.7
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 12 },
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                if (context.parsed.y !== null) {
                                    label += '৳' + context.parsed.y.toLocaleString(undefined, { 
                                        minimumFractionDigits: 2, 
                                        maximumFractionDigits: 2 
                                    });
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { 
                            display: false,
                            drawBorder: false
                        },
                        ticks: { 
                            color: '#6b7280',
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { 
                            color: '#f3f4f6',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280',
                            callback: function(value) {
                                return '৳' + value.toLocaleString();
                            },
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });

        // Burn Distribution Pie Chart
        const burnCtx = document.getElementById('burnDistributionChart').getContext('2d');
        new Chart(burnCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    data: {!! json_encode($lossData) !!},
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(249, 115, 22, 0.7)',
                        'rgba(234, 179, 8, 0.7)',
                        'rgba(20, 184, 166, 0.7)',
                        'rgba(139, 92, 246, 0.7)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 10,
                            padding: 15,
                            usePointStyle: true,
                            font: {
                                size: 11
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ৳${value.toLocaleString()} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
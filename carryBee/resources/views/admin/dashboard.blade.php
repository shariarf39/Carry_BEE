@extends('admin.layout.masterlayout')

@section('content')
<div class="space-y-6">
    <!-- Dashboard Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <h1 class="text-2xl font-bold text-gray-800">Business Dashboard</h1>
        <div class="flex space-x-2 mt-3 md:mt-0">
            <div class="relative">
                <select class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <option>Last 12 Months</option>
                    <option>Last 30 Days</option>
                    <option>Last 7 Days</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-sm"></i>
                </div>
            </div>
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                <i class="fas fa-download mr-2"></i> Export
            </button>
        </div>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Net Profit Card -->
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Net Profit</p>
                    <h3 class="text-2xl font-bold mt-1">৳{{ number_format($netProfit, 2) }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="{{ $netProfit >= 0 ? 'text-green-500' : 'text-red-500' }} text-sm font-medium flex items-center">
                            <i class="fas {{ $netProfit >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1 text-xs"></i> 
                            {{ number_format(abs($netProfit)/1000, 1) }}K
                        </span>
                        <span class="text-gray-500 text-xs ml-2">this period</span>
                    </div>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i class="fas fa-chart-line text-yellow-600"></i>
                </div>
            </div>
        </div>

        <!-- Total Discounts Card -->
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Discounts</p>
                    <h3 class="text-2xl font-bold mt-1">৳{{ number_format($totalDiscounts, 2) }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-red-500 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-down mr-1 text-xs"></i> 
                            {{ $totalActualRevenue > 0 ? number_format($totalDiscounts/$totalActualRevenue*100, 1) : 0 }}%
                        </span>
                        <span class="text-gray-500 text-xs ml-2">of revenue</span>
                    </div>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i class="fas fa-tags text-yellow-600"></i>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <h3 class="text-2xl font-bold mt-1">{{ number_format($totalUsers) }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="{{ $totalUsers >= 0 ? 'text-green-500' : 'text-red-500' }} text-sm font-medium flex items-center">
                            <i class="fas {{ $totalUsers >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1 text-xs"></i> 
                            {{ number_format($totalUsers, 1) }}%
                        </span>
                        <span class="text-gray-500 text-xs ml-2">last month</span>
                    </div>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i class="fas fa-users text-yellow-600"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                    <h3 class="text-2xl font-bold mt-1">৳{{ number_format($totalActualRevenue, 2) }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i> 
                            {{ number_format($totalActualRevenue/1000, 1) }}K
                        </span>
                        <span class="text-gray-500 text-xs ml-2">after discounts</span>
                    </div>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i class="fas fa-money-bill-wave text-yellow-600"></i>
                </div>
            </div>
        </div>

        <!-- Total Loss Card -->
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Loss</p>
                    <h3 class="text-2xl font-bold mt-1">৳{{ number_format($totalLoss, 2) }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-red-500 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-down mr-1 text-xs"></i> 
                            {{ $totalActualRevenue > 0 ? number_format($totalLoss/$totalActualRevenue*100, 1) : 0 }}%
                        </span>
                        <span class="text-gray-500 text-xs ml-2">from discounts</span>
                    </div>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i class="fas fa-exclamation-circle text-yellow-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white rounded-xl shadow-sm p-5 mt-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Discounts & Loss Analytics</h2>
            <div class="flex space-x-2">
                <button class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
        </div>
        <div class="h-80">
            <canvas id="discountsChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
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
                        label: 'Discounts Given',
                        data: {!! json_encode($profitData) !!},
                        backgroundColor: 'rgba(236, 185, 13, 0.7)',
                        borderColor: 'rgba(236, 185, 13, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Estimated Loss',
                        data: {!! json_encode($lossData) !!},
                        backgroundColor: 'rgba(231, 74, 59, 0.7)',
                        borderColor: 'rgba(231, 74, 59, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280'
                        }
                    },
                    y: {
                        stacked: false,
                        grid: {
                            color: '#f3f4f6',
                            drawBorder: false
                        },
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
                                    label += '৳' + context.parsed.y.toLocaleString();
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
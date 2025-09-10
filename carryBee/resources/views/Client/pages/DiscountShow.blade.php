<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Discount Management Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Custom styles to complement Tailwind */
        :root{
            --primary-color: #ecb90d; /* blue-500 */
            --secondary-color: #64748b; /* slate-500 */
            --light-bg: #f8fafc; /* slate-50 */
            --border-color: #e2e8f0; /* slate-200 */
            --success-color: #28a745; /* green-500 */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* slate-50 */
        }

        .back-btn{
            background-color: var(--secondary-color);
            padding: 0.5rem 1rem;
            width: 170px ;
            border-radius: 0.375rem;
            color: white;
        }

        /* Custom styling for responsive table headers */
        @media (max-width: 768px) {
            .responsive-table-cell:before {
                content: attr(data-label);
                font-weight: 600;
                margin-right: 1rem;
                color: #475569; /* slate-600 */
                text-transform: uppercase;
                font-size: 0.75rem;
                line-height: 1rem;
                flex-shrink: 0;
            }
        }
    </style>
    <script>
        // Configuration for Tailwind CSS
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#ecb90d', // blue-500
                            hover: '#ecb90d', // blue-600
                        },
                        secondary: '#64748b', // slate-500
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased text-slate-700">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        
        <header class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800 flex items-center">
                <i class="fas fa-tags mr-3 text-primary-DEFAULT"></i>
                Onboarding Dashboard
            </h1>
            <p class="mt-1 text-slate-500">Manage and track all merchant discounts.</p>
            <div class="text-left mt-4 back-btn">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Back to Home
                </a>
            </div>
        </header>

        <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm mb-6">
            <form action="{{ route('discounts') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4">
                <div class="relative w-full sm:w-auto sm:flex-grow">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="w-full pl-12 pr-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-DEFAULT/50 focus:border-primary-DEFAULT outline-none transition duration-200"
                        placeholder="Search by name, email, ID or phone"
                    />
                </div>
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <button type="submit" class="w-full sm:w-auto bg-primary-DEFAULT hover:bg-primary-hover text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm transition-colors duration-200 flex items-center justify-center">
                        <i class="fas fa-search sm:hidden mr-2"></i>
                        <span>Search</span>
                    </button>
                    <a href="{{ route('discounts') }}" class="w-full sm:w-auto text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-5 py-2.5 rounded-lg transition-colors duration-200">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="hidden md:table-header-group bg-slate-50 border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium">Merchant</th>
                            <th scope="col" class="px-6 py-4 font-medium">Contact</th>
                            <th scope="col" class="px-6 py-4 font-medium">Details</th>
                            <th scope="col" class="px-6 py-4 font-medium">Requirements</th>
                            <th scope="col" class="px-6 py-4 font-medium">Status</th>
                            <th scope="col" class="px-6 py-4 font-medium text-center">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @forelse($discounts as $discount)
                        <tr class="block md:table-row bg-white hover:bg-slate-50 transition-colors duration-150 border-b border-slate-200 last:border-b-0 md:border-b">
                            
                            <td data-label="Merchant" class="responsive-table-cell px-6 py-4 flex md:table-cell items-center justify-between md:justify-start border-b md:border-none">
                                <div class="font-semibold text-slate-800">{{ $discount->merchant_name }} </div>
                                <div class="text-slate-500">{{ $discount->merchant_id }}</div>
                            </td>

                            <td data-label="Contact" class="responsive-table-cell px-6 py-4 flex md:table-cell items-center justify-between md:justify-start border-b md:border-none">
                                <div>
                                    <div class="text-slate-800">{{ $discount->merchant_email }}</div>
                                    <div class="text-slate-500">{{ $discount->phone }}</div>
                                </div>
                            </td>

                            <td data-label="Details" class="responsive-table-cell px-6 py-4 flex md:table-cell items-center justify-between md:justify-start border-b md:border-none">
                                <div>
                                    <div class="text-slate-800">{{ $discount->pickup_hub }}</div>
                                    <div class="text-slate-500">{{ $discount->product_category }} ({{ $discount->promised_parcels }}/day)</div>
                                </div>
                            </td>

                            <td data-label="Requirements" class="responsive-table-cell px-6 py-4 flex md:table-cell items-center justify-between md:justify-start border-b md:border-none">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($discount->requirements ?? [] as $requirement)
                                    <span class="px-2.5 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">
                                        {{ ucwords(str_replace('_', ' ', $requirement)) }}
                                    </span>
                                    @endforeach
                                </div>
                            </td>

                            <td data-label="Status" class="responsive-table-cell px-6 py-4 flex md:table-cell items-center justify-between md:justify-start border-b md:border-none">
                                @if($discount->is_active == 0)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                        <i class="fas fa-clock mr-1.5"></i> Upon Discussion
                                    </span>
                                @elseif($discount->is_active == 1)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1.5"></i> Approved
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1.5"></i> Rejected
                                    </span>
                                @endif
                            </td>

                            <td data-label="Actions" class="responsive-table-cell px-6 py-4 flex md:table-cell items-center justify-end md:justify-center">
                                <div class="flex items-center gap-2">
                                    @if($discount->is_active == 0)
                                    <a href="{{ route('discount.edit', $discount->id) }}" title="Edit" class="h-9 w-9 flex items-center justify-center text-slate-500 hover:bg-slate-200 hover:text-primary-DEFAULT rounded-full transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif

                                    <a href="{{ route('DiscountRuleShow', $discount->id) }}" title="View Details" class="h-9 w-9 flex items-center justify-center text-slate-500 hover:bg-slate-200 hover:text-primary-DEFAULT rounded-full transition-colors duration-200">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('DeRuleShow', $discount->id) }}" title="Manage Rules" class="h-9 w-9 flex items-center justify-center text-slate-500 hover:bg-slate-200 hover:text-primary-DEFAULT rounded-full transition-colors duration-200">
                                        <i class="fas fa-list-check"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 px-6">
                                <i class="fas fa-inbox fa-3x text-slate-300 mb-4"></i>
                                <h3 class="text-xl font-semibold text-slate-700">No Discounts Found</h3>
                                <p class="text-slate-500 mt-1">There are no discounts matching your search criteria.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>
        
        <div class="mt-6">
           
        </div>

    </div>

</body>
</html>
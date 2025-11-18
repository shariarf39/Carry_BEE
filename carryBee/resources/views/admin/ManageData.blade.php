@extends('admin.layout.masterlayout')

@section('content')
    <style>
        :root {
            --primary-color: #ecb90d;
        }
        .card {
            box-shadow: 0 0.15rem 1.75rem rgba(58, 59, 69, 0.15);
            border: none;
        }
        .card-header {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: #d4a50c;
            border-color: #d4a50c;
        }
    </style>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-database me-2" style="color: var(--primary-color);"></i>Manage Data</h2>
            <a href="{{ route('AdminDashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- KAM Management -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-tie me-2"></i>KAM Names
                    </div>
                    <div class="card-body">
                        <form action="{{ route('storeKam') }}" method="POST" class="mb-3">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" placeholder="KAM Name" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </form>

                        <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                            @forelse($kams as $kam)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $kam->name }}</span>
                                    <form action="{{ route('destroyKam', $kam->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="text-muted text-center py-3">No KAMs added yet</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hub Management -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-location-dot me-2"></i>Pick Up Hubs
                    </div>
                    <div class="card-body">
                        <form action="{{ route('storeHub') }}" method="POST" class="mb-3">
                            @csrf
                            <div class="mb-2">
                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Hub Name" required>
                            </div>
                            <div class="input-group">
                                <input type="text" name="location" class="form-control" placeholder="Hub Location" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </form>

                        <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                            @forelse($hubs as $hub)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><strong>{{ $hub->name }}</strong><br><small class="text-muted">{{ $hub->location }}</small></span>
                                    <form action="{{ route('destroyHub', $hub->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="text-muted text-center py-3">No Hubs added yet</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Management -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-tags me-2"></i>Product Categories
                    </div>
                    <div class="card-body">
                        <form action="{{ route('storeCategory') }}" method="POST" class="mb-3">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </form>

                        <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                            @forelse($categories as $category)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $category->name }}</span>
                                    <form action="{{ route('destroyCategory', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="text-muted text-center py-3">No Categories added yet</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

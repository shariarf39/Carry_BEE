@extends('admin.layout.masterlayout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Admin List</h4>
        <!-- Button trigger Add Admin modal -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
            <i class="fa fa-plus"></i> Add Admin
        </button>
    </div>

    <!-- Admins Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at ? $admin->created_at->format('Y-m-d') : '-' }}</td>
                    <td>
                        <!-- Delete form -->
                        <form action="{{ route('destroyAdmin', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this admin?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($admins->isEmpty())
                <tr><td colspan="5" class="text-center">No admins found.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('storeAdmin') }}" method="POST" id="addAdminForm">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAdminModalLabel">Add New Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Name -->
                <div class="mb-3">
                    <label for="adminName" class="form-label">Name</label>
                    <input type="text" name="name" id="adminName" class="form-control" required>
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <label for="adminEmail" class="form-label">Email</label>
                    <input type="email" name="email" id="adminEmail" class="form-control" required>
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="adminPassword" class="form-label">Password</label>
                    <input type="password" name="password" id="adminPassword" class="form-control" required minlength="6">
                </div>
                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="adminPasswordConfirm" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="adminPasswordConfirm" class="form-control" required minlength="6">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Admin</button>
            </div>
        </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
    // Optional: Validate password confirmation in the modal form before submit
    document.getElementById('addAdminForm').addEventListener('submit', function(e){
        const pwd = document.getElementById('adminPassword').value;
        const pwdConfirm = document.getElementById('adminPasswordConfirm').value;
        if (pwd !== pwdConfirm) {
            e.preventDefault();
            alert('Passwords do not match!');
        }
    });
</script>
@endpush

@extends('layouts.app')

@section('title', 'Users - POS Millata')

@section('content')
<div class="top-header">
    <div>
        <h2 class="page-title">Halaman Users</h2>
    </div>
    <div>
        <a href="{{ route('admin.users.create') }}" class="btn d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: white; border: none; font-weight: 700; border-radius: 10px; padding: 0.6rem 1.2rem; box-shadow: 0 4px 10px rgba(3, 105, 161, 0.2);">
            <i class="bi bi-plus-circle-fill"></i> Create User
        </a>
    </div>
</div>

<div class="custom-card">
    <form action="{{ route('admin.users') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control border-end-0"
                placeholder="Search username or email"
                style="border-radius: 12px 0 0 12px; border-color: #f1e5d7; padding: 0.65rem 1rem;"
            >
            <button class="btn btn-outline-secondary px-4" type="submit" style="border-radius: 0 12px 12px 0; border-color: #f1e5d7; background: #faf5ee; color: #78350f; font-weight: 600;">
                <i class="bi bi-search me-1"></i> Search
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle" style="margin: 0;">
            <thead>
                <tr style="background-color: #faf5ee;">
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">#</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Name</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Email</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Role</th>
                    <th scope="col" class="text-end" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="fw-bold" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">{{ $users->firstItem() + $loop->index }}</td>
                    <td class="fw-semibold" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">{{ $user->name }}</td>
                    <td style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">{{ $user->email }}</td>
                    <td style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">
                        <span style="background-color: #fef3c7; color: #b45309; font-weight: 700; padding: 0.35em 0.75em; border-radius: 8px; font-size: 0.75rem;">
                            {{ $user->role->name ?? '-' }}
                        </span>
                    </td>
                    <td class="text-end" style="padding: 0.9rem 1rem; font-size: 0.875rem; border-bottom: 1px solid #FAF0E6;">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm fw-bold text-white px-3 me-1" style="border-radius: 8px; background-color: #f59e0b; border: none;">
                            Edit Akun
                        </a>
                        
                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm fw-bold px-3 text-white" style="border-radius: 8px; background-color: #e11d48; border: none;" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-folder-x fs-3 d-block mb-2"></i>
                        Data user tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4 pt-2 border-top" style="border-color: #faf0e6 !important;">
        {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Hapus user ' + name + '?',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            width: '320px',
            padding: '0.85rem 1rem',
            customClass: {
                popup: 'rounded-4 shadow-sm',
                title: 'fs-6 fw-bold mb-2',
                actions: 'mt-2 mb-0',
                confirmButton: 'rounded-pill px-3 py-1 fs-7 m-1',
                cancelButton: 'rounded-pill px-3 py-1 fs-7 m-1'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush
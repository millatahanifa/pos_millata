@extends('layouts.app')

@section('title', 'Penjualan - POS Millata')

@section('content')
<div class="top-header">
    <div>
        <h2 class="page-title">Halaman Penjualan</h2>
    </div>
    <div>
        <a href="{{ route('penjualan.create') }}" class="btn d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: white; border: none; font-weight: 700; border-radius: 10px; padding: 0.6rem 1.2rem; box-shadow: 0 4px 10px rgba(3, 105, 161, 0.2);">
            <i class="bi bi-plus-circle-fill"></i> Create Penjualan
        </a>
    </div>
</div>

<div class="custom-card">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('penjualan.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control border-end-0"
                placeholder="Search nama kasir..."
                style="border-radius: 12px 0 0 12px; border-color: #f1e5d7; padding: 0.65rem 1rem;"
            >
            <button class="btn btn-outline-secondary px-4" type="submit" style="border-radius: 0 12px 12px 0; border-color: #f1e5d7; background: #faf5ee; color: #78350f; font-weight: 600;">
                <i class="bi bi-search me-1"></i> Search
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle" style="margin: 0; width: 100%; table-layout: fixed;">
            <thead>
                <tr style="background-color: #faf5ee;">
                    <th scope="col" style="width: 6%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">#</th>
                    <th scope="col" style="width: 20%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Tanggal Transaksi</th>
                    <th scope="col" style="width: 16%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Kasir</th>
                    <th scope="col" style="width: 17%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Total Pembayaran</th>
                    <th scope="col" style="width: 14%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Metode</th>
                    <th scope="col" style="width: 11%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Status</th>
                    <th scope="col" class="text-center" style="width: 16%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                <tr>
                    <td class="fw-bold text-truncate" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">{{ $sales->firstItem() + $loop->index }}</td>
                    <td class="text-truncate" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">
                        {{ $sale->created_at ? $sale->created_at->translatedFormat('d-m-Y H:i') : '-' }}
                    </td>
                    <td class="text-truncate" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;" title="{{ $sale->user?->name ?? 'Kasir Tidak Ditemukan' }}">
                        {{ $sale->user?->name ?? 'Kasir Tidak Ditemukan' }}
                    </td>
                    <td class="fw-semibold text-truncate" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">
                        Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                    </td>
                    <td class="text-truncate" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">
                        {{ $sale->metode_pembayaran }}
                    </td>
                    <td style="padding: 0.9rem 1rem; font-size: 0.875rem; border-bottom: 1px solid #FAF0E6;">
                        @if($sale->status === 'COMPLETED')
                            <span class="badge" style="background-color: #d1fae5; color: #065f46; font-weight: 700; padding: 0.35em 0.75em; border-radius: 8px; font-size: 0.75rem;">COMPLETED</span>
                        @else
                            <span class="badge" style="background-color: #fef3c7; color: #b45309; font-weight: 700; padding: 0.35em 0.75em; border-radius: 8px; font-size: 0.75rem;">OPEN</span>
                        @endif
                    </td>
                    <td class="text-center" style="padding: 0.9rem 1rem; font-size: 0.875rem; border-bottom: 1px solid #FAF0E6;">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-sm fw-bold text-white px-2" style="border-radius: 8px; background-color: #0ea5e9; border: none;">Detail</a>

                            @can('update', $sale)
                                @if($sale->status === 'OPEN')
                                <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-sm fw-bold text-white px-2" style="border-radius: 8px; background-color: #f59e0b; border: none;">Edit</a>
                                @endif
                            @endcan

                            @can('delete', $sale)
                            <form id="delete-form-{{ $sale->id }}" action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm fw-bold px-2 text-white" style="border-radius: 8px; background-color: #e11d48; border: none;" onclick="confirmDelete({{ $sale->id }})">
                                    Hapus
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="bi bi-receipt fs-3 d-block mb-2"></i>
                        Data penjualan tidak tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4 pt-2 border-top" style="border-color: #faf0e6 !important;">
        {{ $sales->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Notifikasi Sukses Menggunakan SweetAlert2
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000,
            customClass: {
                popup: 'rounded-4'
            }
        });
    @endif

    // Konfirmasi Hapus Data Disamakan Seperti Halaman Produk
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus transaksi ini?',
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
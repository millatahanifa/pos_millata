@extends('layouts.app')

@section('title', 'Produk - POS Millata')

@section('content')
<div class="top-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
    <div>
        <h1 class="page-title fw-bold mb-1" style="color: var(--primary-dark, #3a1a05); font-size: 1.65rem;">Halaman Produk</h1>
        <div class="date-subtitle text-muted fs-6">
            <i class="bi bi-box-seam me-1"></i> Manajemen data stok dan produk
        </div>
    </div>
    <div>
        @can('create', App\Models\Produk::class)
        <a href="{{ route('produk.create') }}" class="btn d-inline-flex align-items-center gap-2" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: white; border: none; font-weight: 700; border-radius: 10px; padding: 0.5rem 1rem; box-shadow: 0 4px 10px rgba(3, 105, 161, 0.2); width: auto;">
            <i class="bi bi-plus-circle-fill"></i> Tambah Produk
        </a>
        @endcan
    </div>
</div>

<div class="custom-card p-3 p-md-4 bg-white rounded-4 shadow-sm" style="border: 1px solid #f1e5d7;">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <form action="{{ route('produk.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control border-end-0"
                placeholder="Cari nama produk..."
                style="border-radius: 12px 0 0 12px; border-color: #f1e5d7; padding: 0.65rem 1rem;"
            >
            <button class="btn btn-outline-secondary px-4" type="submit" style="border-radius: 0 12px 12px 0; border-color: #f1e5d7; background: #faf5ee; color: #78350f; font-weight: 600;">
                <i class="bi bi-search me-1"></i> Cari
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle" style="margin: 0; width: 100%;">
            <thead>
                <tr style="background-color: #faf5ee;">
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">No</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">Pengguna</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">Foto</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">Nama Produk</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">Harga Beli</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">Harga Jual</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">Stok</th>
                    <th scope="col" class="text-end" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td class="fw-bold" style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">{{ $products->firstItem() + $loop->index }}</td>
                    <td style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">{{ $product->user->name ?? '-' }}</td>
                    <td style="padding: 0.85rem 0.75rem; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">
                        @if($product->foto)
                            <img src="{{ asset('storage/'.$product->foto) }}" class="rounded-3 shadow-sm" style="width: 42px; height: 42px; object-fit: cover; border: 1px solid #fed7aa;">
                        @else
                            <span class="text-muted small">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="fw-semibold" style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6; min-width: 140px;">{{ $product->nama }}</td>
                    <td style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                    <td style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                    <td style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">
                        <span class="badge" style="background-color: #fef3c7; color: #b45309; font-weight: 700; padding: 0.35em 0.75em; border-radius: 8px; font-size: 0.75rem;">
                            {{ $product->stok }}
                        </span>
                    </td>
                    <td class="text-end" style="padding: 0.85rem 0.75rem; font-size: 0.85rem; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">
                        <div class="d-flex justify-content-end gap-1">
                            @can('view', $product)
                            <a href="{{ route('produk.show', $product) }}" class="btn btn-sm fw-bold text-white px-2 py-1" style="border-radius: 6px; background-color: #0ea5e9; border: none; font-size: 0.775rem;">Detail</a>
                            @endcan

                            @can('update', $product)
                            <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm fw-bold text-white px-2 py-1" style="border-radius: 6px; background-color: #f59e0b; border: none; font-size: 0.775rem;">Ubah</a>
                            @endcan

                            @can('delete', $product)
                            <form id="delete-form-{{ $product->id }}" action="{{ route('produk.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm fw-bold px-2 py-1 text-white" style="border-radius: 6px; background-color: #e11d48; border: none; font-size: 0.775rem;" onclick="confirmDelete({{ $product->id }}, '{{ $product->nama }}')">
                                    Hapus
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="bi bi-box-seam fs-3 d-block mb-2"></i>
                        Data produk tidak tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4 pt-3 border-top" style="border-color: #f1e5d7 !important;">
        <div class="text-muted" style="font-size: 0.875rem;">
            Menampilkan <span class="fw-bold text-dark">{{ $products->firstItem() ?? 0 }}</span> sampai <span class="fw-bold text-dark">{{ $products->lastItem() ?? 0 }}</span> dari <span class="fw-bold text-dark">{{ $products->total() }}</span> data
        </div>
        <div class="custom-pagination">
            {{ $products->appends(request()->query())->onEachSide(1)->links('pagination::simple-bootstrap-4') }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .custom-pagination nav {
        display: flex;
        justify-content: center;
    }
    .custom-pagination .pagination {
        margin-bottom: 0;
        gap: 4px;
    }
    .custom-pagination .page-item .page-link {
        color: #78350f;
        border-color: #f1e5d7;
        background-color: #fff;
        border-radius: 8px !important;
        padding: 0.4rem 0.75rem;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .custom-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 10px rgba(3, 105, 161, 0.2);
    }
    .custom-pagination .page-item.disabled .page-link {
        color: #adb5bd;
        background-color: #faf5ee;
        border-color: #f1e5d7;
    }
</style>
@endpush

@push('scripts')
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000,
            customClass: { popup: 'rounded-4' }
        });
    @endif

    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Hapus produk ' + name + '?',
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
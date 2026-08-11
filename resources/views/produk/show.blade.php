@extends('layouts.app')

@section('title', 'Detail Produk - POS Millata')

@section('content')
<div class="top-header d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h1 class="page-title fw-bold mb-1" style="color: var(--primary-dark, #3a1a05); font-size: 1.65rem;">Detail Produk</h1>
        <div class="date-subtitle text-muted fs-6">
            <i class="bi bi-info-circle me-1"></i> Informasi lengkap detail produk dan stok
        </div>
    </div>
    <div>
        <a href="{{ route('produk.index') }}" class="btn d-flex align-items-center gap-2" style="background: #faf5ee; color: #78350f; border: 1px solid #f1e5d7; font-weight: 700; border-radius: 10px; padding: 0.5rem 1rem; transition: all 0.2s;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 200px);">
    <div style="width: 100%; max-width: 850px;">
        <div class="custom-card p-5">
            <div class="row g-5 align-items-center">
                {{-- Bagian Foto Produk (Diperbesar tinggi dan tampilannya) --}}
                <div class="col-md-5 text-center">
                    @if($product->foto)
                        <img src="{{ asset('storage/'.$product->foto) }}" class="img-fluid rounded-4 shadow-sm" alt="{{ $product->nama }}" style="max-height: 280px; object-fit: cover; width: 100%; border: 1px solid #f1e5d7;">
                    @else
                        <div class="bg-light rounded-4 d-flex flex-column align-items-center justify-content-center text-muted" style="height: 240px; border: 1px dashed #f1e5d7;">
                            <i class="bi bi-image display-4 mb-2"></i>
                            <span class="small fw-semibold">Tidak ada foto</span>
                        </div>
                    @endif
                </div>

                {{-- Bagian Informasi Detail (Ukuran font teks diperbesar) --}}
                <div class="col-md-7">
                    <h2 class="fw-bold mb-4" style="color: var(--primary-dark); font-size: 1.8rem;">{{ $product->nama }}</h2>
                    
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th class="ps-0 py-2 text-muted" style="width: 35%; font-size: 1rem;">Dibuat oleh</th>
                            <td class="py-2 fw-semibold" style="color: var(--primary-dark); font-size: 1rem;">: {{ $product->user->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 py-2 text-muted" style="font-size: 1rem;">Harga Beli</th>
                            <td class="py-2 fw-semibold" style="color: var(--primary-dark); font-size: 1rem;">: Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 py-2 text-muted" style="font-size: 1rem;">Harga Jual</th>
                            <td class="py-2 fw-bold" style="color: var(--brand-warm); font-size: 1.15rem;">: Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 py-2 text-muted" style="font-size: 1rem;">Stok</th>
                            <td class="py-2" style="font-size: 1rem;">
                                : <span class="badge" style="background-color: #fef3c7; color: #b45309; font-weight: 700; padding: 0.45em 0.85em; border-radius: 8px; font-size: 0.85rem;">
                                    {{ $product->stok }} Unit
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Tombol Aksi Ubah --}}
            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top" style="border-color: #faf0e6 !important;">
                @can('update', $product)
                <a href="{{ route('produk.edit', $product) }}" class="btn text-white fw-bold px-4 py-2" style="border-radius: 8px; background-color: #f59e0b; border: none; font-size: 0.95rem;">
                    <i class="bi bi-pencil-square me-1"></i> Ubah Produk
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
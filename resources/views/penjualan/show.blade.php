@extends('layouts.app')

@section('title', 'Detail Penjualan - POS Millata')

@section('content')
<div class="top-header">
    <div>
        <h2 class="page-title">Detail Penjualan</h2>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">Informasi lengkap transaksi dan daftar item produk</p>
    </div>
    <div>
        <a href="{{ route('penjualan.index') }}" class="btn d-flex align-items-center gap-2" style="background: #e2e8f0; color: #334155; border: none; font-weight: 700; border-radius: 10px; padding: 0.6rem 1.2rem; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);">
            <i class="bi bi-arrow-left-circle-fill"></i> Kembali
        </a>
    </div>
</div>

<div class="custom-card mb-4">
    <h5 class="fw-bold mb-3" style="color: #78350f; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.5px;">Informasi Transaksi</h5>
    
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0" style="table-layout: fixed;">
            <tbody>
                <tr>
                    <td class="fw-bold text-muted" style="width: 22%; padding: 0.6rem 0; font-size: 0.875rem;">Tanggal Transaksi</td>
                    <td style="width: 3%; padding: 0.6rem 0;">:</td>
                    <td class="fw-semibold text-dark" style="width: 75%; padding: 0.6rem 0; font-size: 0.875rem;">
                        {{ $penjualan->created_at ? $penjualan->created_at->translatedFormat('d-m-Y H:i:s') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted" style="padding: 0.6rem 0; font-size: 0.875rem;">Kasir</td>
                    <td style="padding: 0.6rem 0;">:</td>
                    <td class="fw-semibold text-dark" style="padding: 0.6rem 0; font-size: 0.875rem;">
                        {{ $penjualan->user?->name ?? 'Kasir Tidak Ditemukan' }}
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted" style="padding: 0.6rem 0; font-size: 0.875rem;">Metode Pembayaran</td>
                    <td style="padding: 0.6rem 0;">:</td>
                    <td class="fw-semibold text-dark" style="padding: 0.6rem 0; font-size: 0.875rem;">
                        {{ $penjualan->metode_pembayaran }}
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted" style="padding: 0.6rem 0; font-size: 0.875rem;">Status</td>
                    <td style="padding: 0.6rem 0;">:</td>
                    <td style="padding: 0.6rem 0; font-size: 0.875rem;">
                        <span class="badge" style="background-color: #fef3c7; color: #b45309; font-weight: 700; padding: 0.35em 0.75em; border-radius: 8px; font-size: 0.75rem;">
                            {{ $penjualan->status }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted" style="padding: 0.6rem 0; font-size: 0.875rem;">Total Pembayaran</td>
                    <td style="padding: 0.6rem 0;">:</td>
                    <td class="fw-bold text-dark" style="padding: 0.6rem 0; font-size: 0.95rem; color: #0284c7 !important;">
                        Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="custom-card">
    <h5 class="fw-bold mb-3" style="color: #78350f; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.5px;">Item Produk</h5>

    <div class="table-responsive">
        <table class="table align-middle" style="margin: 0; width: 100%; table-layout: fixed;">
            <thead>
                <tr style="background-color: #faf5ee;">
                    <th scope="col" style="width: 8%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">#</th>
                    <th scope="col" style="width: 37%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Produk</th>
                    <th scope="col" style="width: 20%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Harga Satuan</th>
                    <th scope="col" style="width: 15%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Kuantitas</th>
                    <th scope="col" class="text-end" style="width: 20%; color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 1rem; border-bottom: 1px solid #f1e5d7;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualan->itemPenjualan as $item)
                <tr>
                    <td class="fw-bold text-truncate" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">{{ $loop->iteration }}</td>
                    <td class="fw-semibold text-truncate" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;" title="{{ $item->produk?->nama ?? 'Produk Dihapus' }}">
                        {{ $item->produk?->nama ?? 'Produk Dihapus' }}
                    </td>
                    <td class="text-truncate" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">
                        Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                    </td>
                    <td style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">
                        <span class="badge" style="background-color: #fef3c7; color: #b45309; font-weight: 700; padding: 0.35em 0.75em; border-radius: 8px; font-size: 0.75rem;">
                            {{ $item->kuantitas }}
                        </span>
                    </td>
                    <td class="text-end fw-bold text-truncate" style="padding: 0.9rem 1rem; font-size: 0.875rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-box-seam fs-3 d-block mb-2"></i>
                        Tidak ada item produk pada transaksi ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('title', 'Buat Transaksi Baru - POS Millata')
@section('content')
<div class="top-header d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h1 class="page-title fw-bold mb-1" style="color: var(--primary-dark, #3a1a05); font-size: 1.65rem;">Create Penjualan</h1>
        <div class="date-subtitle text-muted fs-6">
            <i class="bi bi-cart-plus me-1"></i> Buat transaksi penjualan baru
        </div>
    </div>
    <div>
        <a href="{{ route('penjualan.index') }}" class="btn d-flex align-items-center gap-2" style="background: #faf5ee; color: #78350f; border: 1px solid #f1e5d7; font-weight: 700; border-radius: 10px; padding: 0.5rem 1rem;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

@include('penjualan._form')
@endsection
@extends('layouts.app')
@section('title', 'Lanjutkan Transaksi - POS Millata')
@section('content')
<div class="top-header">
    <div>
        <h2 class="page-title">Lanjutkan / Edit Transaksi</h2>
    </div>
    <div>
        <a href="{{ route('penjualan.index') }}" class="btn d-flex align-items-center gap-2" style="background: #faf5ee; color: #78350f; border: 1px solid #f1e5d7; font-weight: 700; border-radius: 10px; padding: 0.6rem 1.2rem;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

@include('penjualan._form')
@endsection
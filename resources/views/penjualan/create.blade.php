@extends('layouts.app')

@section('title', 'Buat Transaksi Baru - Bubu Bakery')

@section('content')
<div class="top-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
    <div>
        <h1 class="page-title fw-bold mb-1" style="color: var(--primary-dark, #3a1a05); font-size: 1.65rem;">Tambah Penjualan</h1>
        <div class="date-subtitle text-muted fs-6">
            <i class="bi bi-plus-circle me-1"></i> Buat transaksi penjualan baru
        </div>
    </div>
</div>

@include('penjualan._form')
@endsection

@push('scripts')
<script>
    function confirmCancelSale(id) {
        Swal.fire({
            title: 'Yakin ingin membatalkan transaksi ini?',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Batal',
            width: '340px',
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
                document.getElementById('cancel-sale-form-' + id).submit();
            }
        });
    }
</script>
@endpush
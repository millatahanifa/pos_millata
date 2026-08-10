@extends('layouts.app')
@section('title', 'Lanjutkan Transaksi - POS Millata')
@section('content')
<div class="top-header d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h1 class="page-title fw-bold mb-1" style="color: var(--primary-dark, #3a1a05); font-size: 1.65rem;">Ubah Penjualan</h1>
        <div class="date-subtitle text-muted fs-6">Lanjutkan atau perbarui transaksi penjualan</div>
    </div>
    <div>
        <a href="{{ route('penjualan.index') }}" class="btn d-flex align-items-center gap-2" style="background: #faf5ee; color: #78350f; border: 1px solid #f1e5d7; font-weight: 700; border-radius: 10px; padding: 0.5rem 1rem;">
            Kembali
        </a>
    </div>
</div>

<div class="container-fluid px-0">
    <div class="custom-card p-3 p-md-4" style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #f1e5d7;">
        @include('penjualan._form')
    </div>
</div>
@endsection

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
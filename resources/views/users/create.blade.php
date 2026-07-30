@extends('layouts.app')

@section('title', 'Tambah User - POS Millata')

@section('content')
<div class="top-header d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h1 class="page-title fw-bold mb-1" style="color: var(--primary-dark, #3a1a05); font-size: 1.65rem;">Tambah User</h1>
        <div class="date-subtitle text-muted fs-6">
            <i class="bi bi-person-plus me-1"></i> Tambahkan pengguna baru ke dalam sistem
        </div>
    </div>
    <div>
        <a href="{{ route('admin.users') }}" class="btn d-flex align-items-center gap-2" style="background: #faf5ee; color: #78350f; border: 1px solid #f1e5d7; font-weight: 700; border-radius: 10px; padding: 0.5rem 1rem; transition: all 0.2s;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="container-fluid px-0 d-flex flex-column justify-content-center" style="min-height: calc(100vh - 180px);">
    <div class="row justify-content-center w-100 m-0">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <div class="custom-card p-4">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    @include('users._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="container-fluid px-4 py-4" style="max-width: 800px; margin: 0 auto;">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #111;">Tambah User</h2>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Tambahkan pengguna baru ke dalam sistem</p>
        </div>
        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary rounded-pill px-3 py-1.5" style="font-size: 0.875rem; border-color: #d1d5db; color: #374151;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            @include('users._form')
        </form>
    </div>
</div>
@endsection
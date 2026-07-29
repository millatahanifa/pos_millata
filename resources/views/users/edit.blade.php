@extends('layouts.app')

@section('title', 'Edit User - POS Millata')

@section('content')
<div class="row justify-content-center my-4">
    <div class="col-12 col-md-10 col-lg-7">
        
        <div class="d-flex align-items-start justify-content-between mb-4">
            <div>
                <h2 class="page-title fw-bold mb-1" style="color: #3d1c02;">Edit User</h2>
                <div class="date-subtitle text-muted fs-6">
                    <i class="bi bi-pencil-square me-1"></i> Perbarui informasi pengguna sistem
                </div>
            </div>
            
            <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary rounded-pill px-3 py-1 fs-6 d-flex align-items-center gap-1 bg-white shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4" style="background-color: #ffffff;">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('users._form')

            </form>
        </div>

    </div>
</div>
@endsection
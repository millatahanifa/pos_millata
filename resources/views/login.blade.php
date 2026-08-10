@extends('layouts.app')

@section('title', 'Login POS')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    body {
        background-color: var(--bg-body) !important;
        background-image: radial-gradient(circle at top left, rgba(255,243,224,0.95) 0%, rgba(254,215,170,0.6) 35%, rgba(248,250,252,0.6) 100%);
        background-blend-mode: overlay;
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        margin: 0;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: "";
        position: fixed;
        top: -12%;
        left: -8%;
        width: 64vw;
        height: 64vh;
        background: radial-gradient(circle at center, rgba(255,235,214,0.9), rgba(255,255,255,0));
        filter: blur(56px);
        pointer-events: none;
        z-index: 0;
    }

    .centered-login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        z-index: 1;
    }

    .bakery-card {
        width: 100%;
        max-width: 420px;
        background: var(--navbar-bg);
        backdrop-filter: blur(6px) saturate(110%);
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        padding: 2.2rem 2rem;
        border: 1px solid var(--card-border);
        position: relative;
        z-index: 2;
    }

    .brand-icon-box {
        width: 58px;
        height: 58px;
        background: linear-gradient(135deg, #78350f 0%, #451a03 100%);
        color: #fef3c7;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 8px 18px rgba(120, 53, 15, 0.12);
    }

    .form-label-custom {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--primary-accent);
        margin-bottom: 0.375rem;
    }

    .input-group-custom {
        position: relative;
    }

    .input-group-custom i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--brand-warm);
        font-size: 1.1rem;
        z-index: 5;
        transition: color 0.2s ease;
    }

    .input-custom {
        height: 46px;
        border-radius: 12px;
        border: 1.5px solid #fed7aa;
        background-color: #fff8f1;
        padding-left: 44px !important;
        font-size: 0.938rem;
        color: var(--primary-dark);
        transition: all 0.2s ease;
    }

    .input-custom:focus {
        border-color: #b45309;
        box-shadow: 0 0 0 3px rgba(180, 83, 9, 0.12);
        background-color: #ffffff;
        outline: none;
    }

    .input-custom:focus + i {
        color: #b45309;
    }

    .btn-bakery {
        height: 46px;
        background: linear-gradient(135deg, #78350f 0%, #451a03 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.938rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 14px rgba(69, 26, 3, 0.25);
    }

    .btn-bakery:hover {
        background: linear-gradient(135deg, #92400e 0%, #78350f 100%);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(69, 26, 3, 0.35);
    }

    .form-check-input:checked {
        background-color: #78350f;
        border-color: #78350f;
    }
</style>

<div class="centered-login-wrapper">
    <div class="bakery-card animate__animated animate__fadeInDown">
        
        <div class="brand-icon-box">
            <i class="bi bi-shop"></i>
        </div>

        <div class="mb-4">
            <h4 class="fw-bold mb-1" style="color: #451a03; letter-spacing: -0.02em;">LOGIN POS</h4>
            <p class="small mb-0" style="color: #92400e;">Masuk ke akun kasir / admin toko.</p>
        </div>

        @if ($errors->has('credentials'))
            <div class="alert alert-danger py-2 px-3 mb-4" role="alert" style="border-radius: 14px; font-size: 0.95rem;">
                {{ $errors->first('credentials') }}
            </div>
        @endif

        <form action="{{ route('auth') }}" method="POST" novalidate>
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label-custom d-block">Email Address</label>
                <div class="input-group-custom">
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        class="form-control input-custom @error('email') is-invalid @enderror" 
                        placeholder="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                    <i class="bi bi-envelope-fill"></i>
                </div>
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label-custom d-block">Password</label>
                <div class="input-group-custom">
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="form-control input-custom @error('password') is-invalid @enderror" 
                        placeholder="••••••••"
                        required
                    >
                    <i class="bi bi-key-fill"></i>
                </div>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label small" for="remember" style="color: #92400e;">
                        Ingat saya
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-bakery w-100 d-flex align-items-center justify-content-center gap-2">
                <span>Masuk</span>
                <i class="bi bi-arrow-right-short fs-5"></i>
            </button>
        </form>

    </div>
</div>

@endsection
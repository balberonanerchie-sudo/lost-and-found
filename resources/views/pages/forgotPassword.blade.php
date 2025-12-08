@extends('layout.guest')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/loginRegister.css') }}">
@endsection

@section('content')
<div class="split-card" style="max-width: 500px; min-height: 400px; margin: 5vh auto;">
    <div class="card-right" style="width: 100%;">
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color: var(--brand-primary);">Forgot Password?</h2>
            <p class="text-muted small">Enter your email and we'll send you a link to reset your password.</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <label class="form-label-custom">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn-action">Send Reset Link</button>
            
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">
                    <i class="bi bi-arrow-left"></i> Back to Login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
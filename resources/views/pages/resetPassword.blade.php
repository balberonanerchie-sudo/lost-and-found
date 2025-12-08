@extends('layout.guest')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/loginRegister.css') }}">
@endsection

@section('content')
<div class="split-card" style="max-width: 500px; min-height: 500px; margin: 5vh auto;">
    <div class="card-right" style="width: 100%;">
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color: var(--brand-primary);">Reset Password</h2>
            <p class="text-muted small">Create a new password for your account.</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label class="form-label-custom">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" required readonly>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">New Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="Min. 8 characters">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-custom">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" placeholder="Confirm password">
            </div>

            <button type="submit" class="btn-action">Reset Password</button>
        </form>
    </div>
</div>
@endsection
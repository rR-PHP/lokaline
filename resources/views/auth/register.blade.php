@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px; border-radius: 10px;">
        <img src="/image/lokalinelogo.png" alt="Logo Lokaline" width="100px" class="m-auto">
        <h2 class="text-center mb-4">{{ __('Register') }}</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name Input -->
            <div class="mb-3">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Email Input -->
            <div class="mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Password Input -->
            <div class="mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Confirm Password Input -->
            <div class="mb-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
            <!-- Register Button -->
            <button type="submit" class="btn btn-dark w-100">{{ __('Register') }}</button>
            <!-- Footer Text -->
            <p class="text-center text-muted mt-4">
                {{ __('Already have an account?') }} <a href="{{ route('login') }}" class="text-decoration-none">{{ __('Login') }}</a>
            </p>
        </form>
    </div>
</div>
@endsection

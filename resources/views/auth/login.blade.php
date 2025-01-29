@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px; border-radius: 10px;">
        <img src="/image/lokalinelogo.png" alt="Logo Lokaline" width="100px" class="m-auto">
        <h2 class="text-center mb-4">{{ __('Login') }}</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Input -->
            <div class="mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
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
            <!-- Login Button -->
            <button type="submit" class="btn btn-dark w-100">{{ __('Login') }}</button>
            <!-- Footer Text -->
            <p class="text-center text-muted mt-4">
                {{ __('Don\'t have an account?') }} <a href="{{ route('register') }}" class="text-decoration-none">{{ __('Register') }}</a>
            </p>
        </form>
    </div>
</div>
@endsection
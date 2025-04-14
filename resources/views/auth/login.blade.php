@extends('pengguna.main')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <h4 class="text-center">Login</h4>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>

            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                <span class="mx-2">|</span>
                <a href="{{ route('register') }}" class="text-decoration-none">Don't have an account?</a>
            </div>
        </form>
    </div>
</div>
@endsection

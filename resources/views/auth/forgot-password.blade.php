@extends('pengguna.main')

@section('title', 'Forgot Password')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <h4 class="text-center">Forgot Password</h4>
        <p class="text-center">Enter your email to receive a password reset link.</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a>
            </div>
        </form>
    </div>
</div>
@endsection

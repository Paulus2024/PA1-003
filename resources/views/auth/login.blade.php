@extends('pengguna.main')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="login-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#4a6cf7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                </svg>
            </div>
            <h2 class="login-title">Welcome Back</h2>
            <p class="login-subtitle">Sign in to continue to your account</p>
        </div>

    @if (session('error'))
        <div class="alert-error">
            <ul style="margin: 0; padding-left: 16px;">
                <li>{{ session('error') }}</li>
            </ul>
        </div>
    @endif

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="Enter Your Email" required autofocus>
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="password" class="form-label">Password</label>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                </div>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Enter Your Password" required>
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
            </div>

            <button type="submit" class="login-button">
                Sign In
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>

            <div class="login-footer">
                <p>Don't have an account? <a href="{{ route('register') }}" class="register-link">Create account</a></p>
            </div>
        </form>
    </div>
</div>

<style>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f8fafc;
    padding: 20px;
}

.login-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 420px;
    overflow: hidden;
}

.login-header {
    padding: 32px 32px 24px;
    text-align: center;
}

.login-icon {
    margin-bottom: 16px;
}

.login-icon svg {
    color: #4a6cf7;
}

.login-title {
    font-size: 24px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
}

.login-subtitle {
    color: #64748b;
    font-size: 14px;
    margin: 0;
}

.alert-error {
    background-color: #f8d7da;
    border: 1px solid #f5c2c7;
    color: #842029;
    padding: 12px 16px;
    border-radius: 8px;
    margin: 0 32px 20px;
    font-size: 14px;
}

.login-form {
    padding: 0 32px 32px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-size: 14px;
    color: #475569;
    margin-bottom: 8px;
    font-weight: 500;
}

.input-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
}

.form-control {
    width: 100%;
    padding: 12px 16px 12px 44px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.2s ease;
    height: 48px;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #4a6cf7;
    box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.1);
}

.label-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.forgot-password {
    font-size: 13px;
    color: #1e293b;
    text-decoration: none;
    font-weight: 500;
}

.forgot-password:hover {
    text-decoration: underline;
}

.login-button {
    width: 100%;
    padding: 14px;
    background-color: #4a6cf7;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    margin-top: 8px;
}

.login-button:hover {
    background-color: #3a5bd9;
}

.login-footer {
    text-align: center;
    margin-top: 24px;
    font-size: 14px;
    color: #64748b;
}

.register-link {
    color: #1e293b;
    font-weight: 500;
    text-decoration: none;
}

.register-link:hover {
    text-decoration: underline;
}
</style>
@endsection

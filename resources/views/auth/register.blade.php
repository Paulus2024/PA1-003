@extends('pengguna.main')

@section('title', 'Register')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="login-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#4a6cf7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
            </div>
            <h2 class="login-title">Create Account</h2>
            <p class="login-subtitle">Register to access our services</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="login-form">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="small">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <div class="input-wrapper">
                    <input type="text" id="name" name="name" class="form-control"
                           placeholder="Enter Your Full Name" required>
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="Enter Your Email" required>
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Make Your Password" required>
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
            </div>

            <button type="submit" class="login-button">
                Register
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>

<div class="login-footer">
    <p>Already have an account? <a href="{{ route('login') }}" class="register-link">Sign in</a></p>
</div>

<div class="social-login">
    <div class="divider">
        <span class="divider-line"></span>
        <span class="divider-text">OR</span>
        <span class="divider-line"></span>
    </div>

    <a href="{{ url('auth/google') }}" class="social-login-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M21.35 11.1h-9.18v2.92h5.42c-.23 1.32-1.12 2.44-2.39 3.08v2.57h3.87c2.27-2.1 3.58-5.2 3.58-8.57 0-.59-.05-1.17-.14-1.72z"/>
            <path d="M12.17 22c2.43 0 4.47-.8 5.96-2.18l-3.87-2.57c-.71.48-1.6.76-2.59.76-1.99 0-3.68-1.35-4.29-3.17h-4.01v2.64c1.48 2.93 4.54 4.92 8.8 4.92z"/>
            <path d="M7.88 14.84a5.033 5.033 0 0 1 0-5.69v-2.64h-4.01a9.973 9.973 0 0 0 0 10.97l4.01-2.64z"/>
            <path d="M12.17 5.36c1.32 0 2.5.45 3.43 1.34l2.57-2.57c-1.66-1.54-3.82-2.49-6-2.49-4.26 0-7.32 1.99-8.8 4.92l4.01 2.64c.61-1.82 2.3-3.17 4.29-3.17z"/>
        </svg>
        Continue with Google
    </a>
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
    max-width: 440px;
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

.login-form {
    padding: 0 32px 32px;
}

.alert-danger {
    background-color: #fff5f5;
    border-left: 4px solid #f56565;
    color: #742a2a;
    padding: 12px 16px;
    border-radius: 6px;
}

.alert-danger ul {
    padding-left: 20px;
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

.social-login {
    margin-top: 24px;
}

.divider {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.divider-line {
    flex: 1;
    height: 1px;
    background-color: #e2e8f0;
}

.divider-text {
    padding: 0 12px;
    color: #64748b;
    font-size: 13px;
    font-weight: 500;
}

.social-login-button {
    width: 100%;
    padding: 12px;
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
}

.social-login-button:hover {
    background-color: #3a5bd9;
}

.social-login-button svg {
    color: white;
}
</style>
@endsection

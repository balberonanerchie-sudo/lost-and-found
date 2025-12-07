@extends('layout.guest')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/loginRegister.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection

@section('content')
    <div class="split-card">

        <div class="card-left">
            <div class="shape-circle c1"></div>
            <div class="shape-circle c2"></div>
            <div class="shape-circle c3"></div>
            <div class="shape-dots"></div>

            <div class="brand-logo">
                <img class="logo" src="{{ asset('img/logo.png') }}" alt="Lost & Found Logo">
                weFind
            </div>

            <div class="hero-content">
                <h1 class="hero-title" id="hero-text">Hello,<br>Welcome!</h1>
            </div>
        </div>

        <div class="card-right">

            <div class="auth-toggle-group">
                <button class="btn btn-toggle-main active" id="tab-login" onclick="switchMode('login')">Login</button>
                <button class="btn btn-toggle-main" id="tab-register" onclick="switchMode('register')">Sign Up</button>
            </div>

            <div class="role-switch" id="role-switcher-container">
                <div class="role-option active" id="role-user" onclick="switchRole('user')">Student</div>
                <div class="role-option" id="role-admin" onclick="switchRole('admin')">Admin</div>
            </div>

            <div id="forms-container">

                {{-- STUDENT LOGIN --}}
                <div class="form-wrapper active" id="form-login-user">
                    <form method="POST" action="{{ route('login.perform') }}">
                        @csrf
                        <input type="hidden" name="login_type" value="student">

                        <div class="mb-3">
                            <label class="form-label-custom">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="user@example.com"
                                value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remUser">
                                <label class="form-check-label" for="remUser"
                                    style="font-size: 0.8rem; color: #888;">Remember me</label>
                            </div>
                            <a href="#" style="font-size: 0.8rem; color: var(--text-muted); text-decoration: none;">
                                Forgot password?
                            </a>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 px-3" style="font-size:0.8rem;">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <button type="submit" class="btn-action">Login</button>
                    </form>
                </div>

                {{-- ADMIN LOGIN --}}
                <div class="form-wrapper" id="form-login-admin">
                    <div class="alert alert-success py-2 px-3 mb-3"
                        style="font-size: 0.8rem; border: 1px solid var(--brand-primary); background: #e8f5e9; color: var(--brand-dark);">
                        <i class="bi bi-shield-lock me-1"></i> Admin Portal
                    </div>
                    <form method="POST" action="{{ route('login.perform') }}">
                        @csrf
                        <input type="hidden" name="login_type" value="admin">

                        <div class="mb-3">
                            <label class="form-label-custom">Admin Email</label>
                            <input type="email" name="email" class="form-control" placeholder="admin@wefind.com"
                                value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Secure Key</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••">
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 px-3" style="font-size:0.8rem;">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <button type="submit" class="btn-action">Access Dashboard</button>
                    </form>
                </div>

                {{-- STUDENT REGISTER --}}
                <div class="form-wrapper" id="form-register-user">
                    <form method="POST" action="{{ route('register.perform') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label-custom">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe"
                                value="{{ old('name') }}">
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label-custom">Contact No.</label>
                                <input type="tel" class="form-control" placeholder="09XX...">
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom">Birthdate</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="name@email.com"
                                value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Create Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••">
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="termsCheck">
                            <label class="form-check-label" for="termsCheck" style="font-size: 0.8rem; color: #888;">
                                I agree to the <a href="#" class="terms-link">Terms & Conditions</a>
                            </label>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 px-3" style="font-size:0.8rem;">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <button type="submit" class="btn-action">Create Account</button>
                    </form>
                </div>

            </div>

            <div class="social-area">
                <span class="social-label">FOLLOW</span>
                <i class="bi bi-facebook social-icon"></i>
                <i class="bi bi-twitter-x social-icon"></i>
                <i class="bi bi-instagram social-icon"></i>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let currentMode = 'login'; // login or register
        let currentRole = 'user';  // user or admin

        function updateUI() {
            document.querySelectorAll('.form-wrapper').forEach(el => el.classList.remove('active'));

            const targetId = `form-${currentMode}-${currentRole}`;
            const targetForm = document.getElementById(targetId);
            if (targetForm) {
                targetForm.classList.add('active');
            }

            const heroText = document.getElementById('hero-text');
            heroText.style.animation = 'none';
            heroText.offsetHeight;
            heroText.style.animation = null;

            if (currentMode === 'login') {
                heroText.innerHTML = "Hello,<br>Welcome!";
            } else {
                heroText.innerHTML = "Join<br>weFind!";
            }
        }

        function switchMode(mode) {
            currentMode = mode;

            document.querySelectorAll('.btn-toggle-main').forEach(btn => btn.classList.remove('active'));
            document.getElementById(`tab-${mode}`).classList.add('active');

            const roleSwitcher = document.getElementById('role-switcher-container');

            if (mode === 'register') {
                switchRole('user');
                roleSwitcher.style.display = 'none';
            } else {
                roleSwitcher.style.display = 'flex';
            }

            updateUI();
        }

        function switchRole(role) {
            currentRole = role;
            document.querySelectorAll('.role-option').forEach(opt => opt.classList.remove('active'));
            document.getElementById(`role-${role}`).classList.add('active');
            updateUI();
        }
    </script>
@endsection

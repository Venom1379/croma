<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<main class="auth-cover-wrapper">
    <div class="auth-cover-content-inner">
        <div class="auth-cover-content-wrapper">
            <div class="auth-img">
                {{-- <img src="{{ asset('assets/') }}" class="img-fluid"> --}}
              <img src="{{ asset('assets/images/hero.png') }}" alt="Hero Image" width="100%" height="100%">

            </div>
        </div>
    </div>

    <div class="auth-cover-sidebar-inner">
        <div class="auth-cover-card-wrapper">
            <div class="auth-cover-card p-sm-5">

                {{-- <div class="wd-50 mb-5">
                    <img src="{{ asset('assets/images/logo-abbr.png') }}" class="img-fluid">
                </div> --}}

                <h2 class="fs-20 fw-bolder mb-4">Login</h2>
                <h4 class="fs-13 fw-bold mb-2">Login to your account</h4>

                {{-- GLOBAL ERRORS --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" class="w-100 mt-4 pt-2">
                    @csrf

                    <div class="mb-4">
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Email"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 position-relative">
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control pe-5"
                               placeholder="Password"
                               required>
                    
                        <i class="bi bi-eye-slash position-absolute"
                           id="togglePassword"
                           style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; font-size: 18px;">
                        </i>
                    
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember Me</label>
                        </div>

                        {{-- <a href="{{ route('password.request') }}" class="fs-11 text-primary">
                            Forgot password?
                        </a> --}}
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-lg btn-primary w-100">
                            Login
                        </button>
                    </div>
                </form>

                {{-- <div class="mt-5 text-muted text-center">
                    <span>Don’t have an account?</span>
                    <a href="{{ route('register') }}" class="fw-bold">Create Account</a>
                </div> --}}

            </div>
        </div>
    </div>
</main>

<script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/js/common-init.min.js') }}"></script>
<script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");

    togglePassword.addEventListener("click", function () {
        if (password.type === "password") {
            password.type = "text";
            // this.textContent = "🙈";
        } else {
            password.type = "password";
            // this.textContent = "👁";
        }
    });

});
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fu System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <!-- الشعار -->
    <picture>
        <img src="{{ asset('assets/logowithname.svg') }}" class="logo" alt="logo" draggable="false">
    </picture>

    <!-- صور الخلفية -->
    <img src="{{ asset('assets/bottomleft.svg') }}" class="bottom-left" alt="bottomleft" draggable="false">
    <img src="{{ asset('assets/topright.svg') }}" class="top-right" alt="topright" draggable="false">

    <!-- الحاوية الرئيسية -->
    <div class="container col-12" style="flex-direction: row;">
        <div class="row g-0 col-12">
            <!-- قسم تسجيل الدخول -->
            <div class="left-form col-12 col-md-4 p-4 align-content-center">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="form mt-4">
                    @csrf

                    <h2 class="text-center mb-4" style="color: #6C3A30;">Welcome Back</h2>

                    <!-- البريد الإلكتروني -->
                    <div class="mb-3">
                        <label for="email" class="form-label" style="color: #B77848;">Username</label>
                        <input type="email" id="email" name="email"
                               class="form-control form-control-sm"
                               value="{{ old('email') }}" required autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- كلمة السر -->
                    <div class="mb-3">
                        <label for="password" class="form-label" style="color: #B77848;">Password</label>
                        <input type="password" id="password" name="password"
                               class="form-control form-control-sm"
                               required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- رابط استرجاع كلمة السر -->
                    @if (Route::has('password.request'))
                        <div class="mb-3 text-end">
                            <a href="{{ route('password.request') }}" class="text-decoration-none small text-muted">
                                Forgot password?
                            </a>
                        </div>
                    @endif

                    <!-- تذكرني -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember" style="color: #6C3A30; font-size: 12px;">
                            Remember my username
                        </label>
                    </div>

                    <!-- زر الدخول -->
                    <button type="submit" class="btn btn-outline-dark w-100" style="margin-top:10px;">
                        Login
                    </button>
                </form>
            </div>

            <!-- قسم الصورة الجانبية -->
            <div class="img-container col-8 g-0 d-none d-md-block">
                <img src="{{ asset('assets/paintinglogin2.svg') }}" alt="..." draggable="false" class="img-fluid">
                <h2 class="text-overlay">Welcome to Voice Line</h2>
            </div>
        </div>
    </div>

    <!-- سكربتات -->
    <script src="{{ asset('js/localization.js') }}"></script>
    <script src="{{ asset('js/cardflip.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

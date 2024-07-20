<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('css/login1.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <div class="logo-container">
            <a href="/">
                <img src="{{ asset('image/Banjarbaru.png') }}" alt="Logo" class="logo">
            </a>
            <p class="logo-text">SOHIB BANJARBARU</p>
        </div>
        <div class="form-section">
            <form action="{{ route('google.redirect') }}" method="GET" class="form-container" id="loginForm">
                @csrf
                @if (Session('error'))
                    <div class="alert alert-danger">
                        {{ Session('error') }}
                    </div>
                @endif
                <h2 class="form-title">Login</h2>
                <div class="google-login">
                    <a href="{{ route('google.redirect') }}" class="google-btn">
                        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Icon">
                        <span>Login Dengan Akun Google</span>
                    </a>
                </div>
            </form>
        </div>
    </div>

    @include('sweetalert::alert')
</body>

</html>

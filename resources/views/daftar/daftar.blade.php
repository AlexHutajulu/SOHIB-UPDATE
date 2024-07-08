<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <a href="/">
                <img src="{{ asset('image/Banjarbaru.png') }}" alt="Logo Banjarbaru" class="logo">
            </a>
        </div>
        <span class="form-title">SISTEM ONLINE HIBAH BANJARBARU</span>
        @if (Session('error'))
            <div class="alert alert-danger">
                {{ Session('error') }}
            </div>
        @endif
        <div class="google-signup">
            <a href="{{ route('google.redirect') }}">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Icon">
                Daftar Akun melalui Google
            </a>
            <p class="google-description">Daftar Akun SOHIB melalui Google</p>
        </div>
    </div>
</body>
</html>

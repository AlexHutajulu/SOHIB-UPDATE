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
        <form action="{{ route('daftar.post') }}" method="POST" class="form-container">
            @csrf
            @if (Session('error'))
                <div class="alert alert-danger">
                    {{ Session('error') }}
                </div>
            @endif
            <a href="/" class="form-title">Daftar Akun</a>
            <!-- NIK -->
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" id="nik" name="nik" placeholder="Masukkan NIK Anda" required>
                @error('nik')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="name">Nama Lengkap:</label>
                <input type="text" id="name" name="name" placeholder="Masukkan Nama Lengkap Anda" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Masukkan Email Anda" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password Anda" required>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit">Daftar</button>
            </div>

            <div class="google-signup">
                <a href="{{ route('google.redirect') }}">
                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Icon">
                    Daftar Akun melalui Google
                </a>
            </div>
        </form>
    </div>
</body>
</html>

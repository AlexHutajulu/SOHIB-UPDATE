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
            <form action="{{ route('postlogin') }}" method="POST" class="form-container" id="loginForm">
                @csrf
                @if (Session('error'))
                    <div class="alert alert-danger">
                        {{ Session('error') }}
                    </div>
                @endif
                <h2 class="form-title">Login</h2>
                <div class="form-group">
                    <label for="email">NIK Atau Email:</label>
                    <input type="text" id="email" name="email" placeholder="Masukkan NIK atau Email Anda" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Password Anda" required>
                </div>
                <div class="form-group">
                    <button type="submit" onclick="checkRoleAndSubmit()">Login</button>
                </div>
                <div class="google-login">
                    <span>atau</span>
                    <a href="{{ route('google.redirect') }}" class="google-btn">
                        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Icon">
                        <span>Login dengan Google</span>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function checkRoleAndSubmit() {
            var emailInput = document.getElementById('email');
            var emailValue = emailInput.value;

            if (emailValue.includes('@') && emailValue.includes('.')) {
                document.getElementById('loginForm').action = "{{ route('postlogin') }}";
            } else {
                document.getElementById('loginForm').action = "{{ route('postlogin') }}";
            }

            document.getElementById('loginForm').submit();
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
    @if (session()->has('success'))
            <div class="success-message">
                {{ session()->get('success') }}
            </div>
        @endif 

        @if (session()->has('error'))
            <div class="error-message">
                {{ session()->get('error') }}
            </div>
        @endif 
        <h2>Kaydol</h2>
        <form id="registerForm" method="POST">
            @csrf
            <div>
                <label for="name">Adınız-Soyadınız:</label> 
                <input id="name" type="text" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="error-message"><span class="error">{{ $message }}</span></div>
                @enderror
            </div>

            <div>
                <label for="email">E-posta Adresiniz:</label>
                <input id="email" type="text" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="error-message "><span class="error">{{ $message }}</span></div>
                @enderror
            </div>

            <div>
                <label for="password">Şifre:</label>
                <input id="password" type="password" name="password" autocomplete="new-password">
                @error('password')
                    <div class="error-message"><span class="error">{{ $message }}</span></div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation">Şifreyi Tekrar Girin:</label>
                <input id="password_confirmation" type="password" name="password_confirmation">
                @error('password_confirmation')
                    <div class="error-message"><span class="error">{{ $message }}</span></div>
                @enderror
            </div>
            
            <div class="centered-button"><button class="submit-button" type="submit">Kaydol</button></div>
            <label>Zaten bir hesabınız var mı?<a class="link" href="login">Giriş Yap</a></label>
        </form>
    </div>
</body>
</html>

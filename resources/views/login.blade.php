<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
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
        <h2>Giriş Yap</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email">E-posta Adresiniz:</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}">

            </div>

            <div>
                <label for="password">Şifre:</label>
                <input id="password" type="password" name="password" autocomplete="current-password">
                @error('password')
                <div class="error-message"><span class="error">{{$message}}</span></div>
                @enderror
            </div>
            
            <div class="centered-button">
                <button class="submit-button" type="submit">Giriş Yap</button>
                </div>
                <br></br>
            <label>Hesabınız yok mu?<a class="link" href="register">Kaydol</a></label>
        </form>
    </div>
</body>
</html>

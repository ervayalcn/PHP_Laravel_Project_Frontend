<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
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
        @if (session()->has('token'))
            <h1>Hoş Geldiniz</h1>
        @endif
            <h1>Ürünler</h1>
            <button class="login-button"><a href="{{ route('products.create') }}" class="links">Yeni Ürün Ekle</a></button>
            <br><br>
            @if (empty($products))
            <p>Henüz hiç ürün eklenmemiş.</p>
            @else
    <table class="table">
        <thead>
            <tr>
                <th>Ürün Adı</th>
                <th>Fiyat</th>
                <th>Açıklama</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['product_name'] }}</td>
                    <td>{{ $product['product_price'] }}</td>
                    <td>{{ $product['description'] }}</td>
                    <td>
                        <div class="button-group">
                            <button class="login-button"><a href="{{ route('products.show', $product['id']) }}" class="links">Görüntüle</a></button>

                            <form action="{{ route('products.destroy', $product['id']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="login-button" onclick="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">Sil</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    
@endif

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <br><br>
            <button class="login-button" id="logout-btn">Çıkış Yap</button>

            @if (session('token'))
                <input type="hidden" name="token" value="{{ session('token') }}">

        @else
            <div class="login-message">
                <p>Verileri görmek için giriş yapmalısınız.</p>
                <a href="{{ route('login') }}" class="login-button">Giriş Yap</a>
            </div>
        @endif
    </div>
    <script>
        document.getElementById('logout-btn').addEventListener('click', function() {
            document.getElementById('logout-form').submit();
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['product_name'] }}</title>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <p>Ürün Adı: {{ $product['product_name'] }}</p>
        <p>Fiyat: {{ $product['product_price'] }}</p>
        <p>Açıklama: {{ $product['description'] }}</p>
        <div class="button-group">
            <button class="login-button"><a href="{{ route('products.edit', [$product['id']]) }}" class="links">Düzenle</a></button>
            <form action="{{ route('products.destroy', $product['id']) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="login-button" onclick="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">Sil</button>
            </form>
            <button class="login-button"><a href="{{ route('products.index') }}" class="links">Ürünlere Dön</a></button>
        </div>
    </div>
</body>
</html>

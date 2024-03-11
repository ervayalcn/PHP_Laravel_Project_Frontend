<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünü Düzenle</title>
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
        <h3>Ürünü Düzenle</h3>

        <form action="{{ route('products.update', [$product['id']]) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="product_name">Ürün Adı:</label>
                <input type="text" id="product_name" name="product_name" value="{{ $product['product_name'] }}">
                @error('product_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="product_price">Fiyat:</label>
                <input type="text" id="product_price" name="product_price" value="{{ $product['product_price'] }}">
                @error('product_price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="description">Açıklama:</label>
                <textarea class="desc" id="description" name="description">{{ $product['description'] }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-button">Güncelle</button>
        </form>
    </div>
</body>
</html>

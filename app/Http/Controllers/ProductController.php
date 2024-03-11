<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->session()->get('token');
        
        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Giriş yapmalısınız']);
        }
        
        $response = Http::withToken($token)->get('http://host.docker.internal:81/api/index');
        
        if ($response->successful()) {
            $products = $response->json();
            return view('index', ['products' => $products]);
        } else {
            return redirect()->route('login')->withErrors(['error' => 'Ürünler alınamadı']);
        }
    }
    
    public function create()
    {
        $token = session('token');
        if($token) {
            return view('create');
        }
        return redirect()->route('login');
    }

    public function store(Request $request)
    {
        $token = session('token');
        if($token) {
            $response = Http::withToken($token)->post('http://host.docker.internal:81/api/products', [
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'description' => $request->description,
            ]);

            if ($response->successful()) {
                return redirect()->route('products.index')->with('success', 'Ürün başarıyla oluşturuldu.');
            }else {
                    return redirect()->back()->with(['error' => 'Lütfen ürün bilgilerini eksiksiz doldurun ve fiyat bilgisi için yalnızca nümerik karakterler kullanın .']);
                }
        }
    }

    public function show(string $id, Request $request)
    {
        $token = $request->session()->get('token');
        $response = Http::withToken($token)->get("http://host.docker.internal:81/api/products/{$id}");
        
        if ($response->successful()) {
            $productDetails = $response->json();
            
            return view('show', ['product' => $productDetails]);
        } else { 
            return redirect()->route('products.index')->withErrors(['error' => 'Ürün detayları alınamadı']);
        }
    }
    

    public function destroy(Request $request, $id)
    {
        $token = $request->session()->get('token');
    
        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Giriş yapmalısınız']);
        }
        
        $response = Http::withToken($token)->delete("http://host.docker.internal:81/api/products/{$id}");
    
        if ($response->successful()) {
            return redirect()->route('products.index')->with('success', 'Ürün başarıyla silindi.');
        } else {
            return redirect()->back()->with(['error' => 'Ürün silinirken bir hata oluştu. Lütfen tekrar deneyin.']);
        }
    }
    
public function edit($id)
{
    $token = session('token');
    if ($token) {
        $response = Http::withToken($token)->get("http://host.docker.internal:81/api/products/{$id}");
        
        if ($response->successful()) {
            $productDetails = $response->json();
            
            return view('edit', ['product' => $productDetails]);
        } else { 
            return redirect()->route('products.index')->withErrors(['error' => 'Ürün detayları alınamadı']);
        }
    }
    return redirect()->route('login');
}

public function update(string $id, Request $request)
{
    $token = $request->session()->get('token');
    
    if (!$token) {
        return redirect()->route('login')->withErrors(['error' => 'Giriş yapmalısınız']);
    }
    
    $response = Http::withToken($token)->put("http://host.docker.internal:81/api/products/{$id}", [
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'description' => $request->description,
    ]);

    if ($response->successful()) {
        return redirect()->route('products.index')->with('success', 'Ürün başarıyla güncellendi.');
    } else {
        return redirect()->back()->with(['error' => 'Lütfen ürün bilgilerini eksiksiz doldurun ve fiyat bilgisi için yalnızca nümerik karakterler kullanın .']);
    }
}

}

?>
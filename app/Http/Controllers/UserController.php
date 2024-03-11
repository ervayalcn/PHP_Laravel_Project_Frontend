<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request) {
        $response = Http::post('http://host.docker.internal:81/api/register', [
            'email'=>$request->email,
            'name'=>$request->name,
            'password'=>$request->password,
            'password_confirmation'=>$request->password_confirmation,
        ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
        } else {
            return redirect()->back()->with(['error' => 'Lütfen bilgileri eksiksiz doldurun, maili doğru yazdığınızdan ve şifrelerin eşleştiğinden emin olun.']);
        }
    }
    
    public function signin(){
        return view('login');
    }

    public function login(Request $request)
    {
        $response = Http::post('http://host.docker.internal:81/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        //dd($response);

        $responseData = $response->json();
        //dd($responseData);
        //dd($response);
        if ($response->successful()) {
            $responseData = $response->json();
            $tokenWithId = $responseData['token'];
            $tokenParts = explode("|", $tokenWithId);
            $token = end($tokenParts);
            session(['token' => $token]);
            return redirect()->route('products.index')->with('success', 'Giriş yapıldı.');

        }
        else {
            return redirect()->back()->with(['error' => 'Giriş başarısız. Lütfen bilgilerinizi kontrol edin.']);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->session()->get('token');
    
        if ($token) {
            $request->session()->forget('token'); 
            return redirect()->route('login')->with('success', 'Başarıyla çıkış yapıldı');
        } else {
            return response()->json(['message' => 'Kullanıcı girişi bulunamadı'], 401);
        }
    }
}

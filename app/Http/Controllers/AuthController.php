<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login($guard)
    {
        if ($guard === 'templates' && Auth::guard('templates')->check()) {
            return redirect()->route('templates');
        }

        return view($guard.'.login');
    }

    public function postLogin($guard, Request $request)
    {
        if($guard == 'templates'){
            $request->merge(['email' => 'toriyama@web-ad.co.jp']);
        }
        $credentials = [
            'email' => $request->input('email'),
            'password'=>$request->input('password')];

        if (Auth::guard($guard)->attempt($credentials)) {
            $request->session()->regenerate();
            if ($guard === 'admin') {
                return redirect()->route('wb-admin.dashboard');
            } elseif ($guard === 'templates') {
                return redirect()->route('templates.index');
            }
        }
        return back()->withErrors([
            'email' => 'ログインに失敗しました。',
        ]);
    }
    public function getAutoLogin($email, $password)
    {
        if(!isset($_SERVER['HTTP_REFERER']) || url('/wb-admin/shop') != $_SERVER['HTTP_REFERER']) {
            echo '404エラー';
            exit;
        }

        if (Auth::guard('shop')->check()) {
            return view('shop.already');
        }

        $credentials = [
            'email' => $email,
            'password'=>$password
        ];

        if (Auth::guard('shop')->attempt($credentials)) {
            return redirect()->route('shop-admin.top');
        }

        return back()->withErrors([
            'email' => 'ログインに失敗しました。',
        ]);
    }

    public function logout(Request $request, $guard)
    {

        Auth::guard($guard)->logout();

//        自社店舗両方のログイン情報が破棄される為コメントアウト
//        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login/'.$guard);
    }
}

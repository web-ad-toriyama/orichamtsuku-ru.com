<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login($guard='admin')
    {
        if ($guard === 'templates' && Auth::guard('templates')->check()) {
            return redirect()->route('templates');
        }

        return view($guard.'.login');
    }

    public function postLogin($guard='admin', Request $request)
    {
        if($guard == 'templates'){
            $request->merge(['email' => env('TEMPLATE_LOGIN_ADDRESS')]);
        }
        $credentials = [
            'email'   => $request->input('email'),
            'password'=> $request->input('password')];

        if (Auth::guard($guard)->attempt($credentials)) {
            $request->session()->regenerate();
            if ($guard === 'admin') {
                return redirect()->route('wb-admin.dashboard');
            } elseif ($guard === 'templates') {
                return redirect()->route(config('custom.page.category11.route'));
            }
        }
        return back()->withErrors([
            'email' => 'ログインに失敗しました。',
        ]);
    }

    public function logout(Request $request, $guard='admin')
    {

        Auth::guard($guard)->logout();

//        自社テンプレート両方のログイン情報が破棄される為コメントアウト
//        $request->session()->invalidate();

        $request->session()->regenerateToken();
        if($guard == 'admin'){
            $guard = '';
        }
        return redirect('login/'.$guard);
    }
}

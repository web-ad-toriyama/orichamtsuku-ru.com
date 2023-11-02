<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TemplatePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TemplateAuthController extends Controller
{
    /**
     * ログイン画面表示
     *
     * @return void
     */
    public function login()
    {
        // ログイン状態の場合、管理画面にリダイレクトさせる
        if (Auth::guard('template_passwords')->check()) {
            return redirect()->route(config('custom.page.category11.route'));
        }
        return view('login');
    }

    /**
     * ログイン処理
     *
     * @param Request $request
     * @return void
     */
    public function postLogin(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('template_login')
                        ->withErrors($validator)
                        ->withInput();
        }
        // 認証処理
        $credentials = $request->validate([
            'password' => ['required'],
        ]);
        if (TemplatePassword::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('template');
        }
        return back()->withErrors([
            'email' => 'ログインに失敗しました。',
        ]);
    }

    /**
     * ログアウト処理
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('template_login');
    }
}

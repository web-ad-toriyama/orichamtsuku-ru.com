<?php

namespace App\Http\Controllers;

use App\Models\Log as ModelsLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactShipped;
use App\Mail\ContactCompleted;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function confirm(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'contact_name' => 'required',
            'contact_email' => 'required|confirmed',
            'contact_email_confirmation' => 'required',
            'contact_tel' => 'required',
            'contact_requirement' => 'required',
            'contact_contents' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route(config('custom.page.contact.route'))
                        ->withErrors($validator)
                        ->withInput();
        }
        // バリデーション済みデータの取得
        $validated = $validator->validated();

        return view('contact_confirm', compact('validated'));
    }

    public function send(Request $request)
    {
        // 二重送信対策
        $request->session()->regenerateToken();

        $values = [
            'name' => $request->input('contact_name'),
            'email' => $request->input('contact_email'),
            'tel' => $request->input('contact_tel'),
            'requirement' => $request->input('contact_requirement'),
            'contents' => $request->input('contact_contents'),
        ];
        // ログデータ書き込み
        ModelsLog::create($values);
        // メール送信実行
        Mail::send(new ContactShipped($values));

        Mail::send(new ContactCompleted($values));

        return view('contact_send');
    }

    public function error()
    {
        // 直接URLを叩いて確認画面や送信完了画面に入った場合、エラーとする。
        return redirect()->route(config('custom.page.contact.route'));
    }
}

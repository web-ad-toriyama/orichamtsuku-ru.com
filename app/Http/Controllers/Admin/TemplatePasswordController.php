<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TemplatePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class TemplatePasswordController extends Controller
{
    /**
     * 一覧画面表示
     *
     * @return void
     */
    public function index()
    {
        return view('admin.template_password.index');
    }

    /**
     * データ削除処理
     *
     * @param Request $request
     * @return void
     */
    public function postIndex(Request $request)
    {
        // バリデーション
        $validator = $this->_validator($request);
        if ($validator->fails()) {
            return redirect()->route('wb-admin.template_password.index')
                ->withErrors($validator)
                ->withInput();
        }
        // データ新規登録
        try {
            DB::beginTransaction();
            // バリデーション済みデータの取得
            $validated = $validator->validated();
            $form['password'] = bcrypt($validated['password']);
            // 新規登録処理
            $post = TemplatePassword::create($form);
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();

            return redirect()->route('wb-admin.template_password.index')->with('error_message', 'データの登録に失敗しました。');
        }

        return redirect()->route('wb-admin.template_password.index')->with('success_message', 'データの登録に成功しました。');
    }

    /**
     * バリデーション実施
     *
     * @param Request $request
     * @return object
     */
    private function _validator(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ],
            [
                'name.required' => 'パスワードは必ず指定してください。',
            ]);

        return $validator;
    }

}

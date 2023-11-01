<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class SampleController extends Controller
{
    /**
     * 一覧画面表示
     *
     * @return void
     */
    public function index()
    {
        // 親カテゴリー取得
        $categories = $this->_getCategory();
        unset($categories['']);
        // データ取得
        $posts = [];
        foreach ($categories as $key => $value) {
            $posts[$value] = Sample::where('category_id', $key)->orderBy('sequence', 'DESC')->get();
        }

        return view('admin.sample.index', compact('posts'));
    }

    /**
     * データ削除処理
     *
     * @param Request $request
     * @return void
     */
    public function postIndex(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->input('del') as $id) {
                // 該当ディレクトリ削除
                Storage::disk('post')->deleteDirectory($id);
                // データ削除
                Sample::destroy($id);
            }
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('wb-admin.sample.index')->with('error_message', 'データの削除に失敗しました。');
        }

        return redirect()->route('wb-admin.sample.index')->with('success_message', 'データの削除に成功しました。');
    }


    /**
     * 一覧画面表示（並び替え用）
     *
     * @param null $category_id
     * @return void
     */
    public function sort($category_id = null)
    {
        // 親カテゴリー取得
        $categories = $this->_getCategory();
        if (is_null($category_id)) {
            // データ取得（カテゴリ選択なし）
            $posts = Sample::orderBy('sequence', 'DESC')->get();
        } else {
            // データ取得（カテゴリ選択あり）
            $posts = Sample::where('category_id', $category_id)->orderBy('sequence', 'DESC')->get();
        }

        return view('admin.sample.sort', compact('posts', 'categories', 'category_id'));
    }

    /**
     * 並び替え処理
     *
     * @param Request $request
     * @return void
     */
    public function postSort(Request $request)
    {
        if ($request->input('id') == null) {
            return redirect()->route('wb-admin.sample.index')->with('error_message', 'データの並び替えが行われていません。');
        }

        $index = count($request->input('id'));

        try {
            DB::beginTransaction();
            foreach ($request->input('id') as $id) {
                Sample::where('id', $id)->update(['sequence' => $index]);
                $index--;
            }
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('wb-admin.sample.index')->with('error_message', 'データの並び替えに失敗しました。');
        }

        return redirect()->route('wb-admin.sample.index')->with('success_message', 'データの並び替えに成功しました。');
    }

    /**
     * 表示切り替え処理
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function display(Request $request, int $id)
    {
        $post = Sample::find($id);
        $display = config('custom.display.on');
        if ($post->display ==  config('custom.display.on')) {
            $display = config('custom.display.off');
        }

        try {
            Sample::where('id', $post->id)->update(['display' => $display]);
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.sample.index', ['page'=>$request->get('page')])->with('error_message', '表示状態の変更に失敗しました。');
        }

        return redirect()->route('wb-admin.sample.index', ['page'=>$request->get('page')])->with('success_message', '表示状態の変更に成功しました。');
    }

    /**
     * 登録画面表示
     *
     * @return void
     */
    public function add()
    {
        // 親カテゴリー取得
        $categories = $this->_getCategory();

        return view('admin.sample.add', compact('categories'));
    }

    /**
     * 新規登録処理
     *
     * @param Request $request
     * @return void
     */
    public function postAdd(Request $request)
    {
        // バリデーション
        $validator = $this->_validator($request);
        if ($validator->fails()) {
            return redirect()->route('wb-admin.sample.add')
                ->withErrors($validator)
                ->withInput();
        }
        // データ新規登録
        try {
            DB::beginTransaction();
            // バリデーション済みデータの取得
            $validated = $validator->validated();
            $validated['display'] = config('custom.display.on');
            // 並び順設定
            $validated['sequence'] = Sample::max('sequence')+1;
            // 新規登録処理
            $post = Sample::create($validated);
            // 画像アップロード
            Storage::disk('post')->makeDirectory($post->id);
            $path1 = $request->file('file1')->store($post->id, 'post');
            // データ更新
            Sample::where('id', $post->id)->update(['file_path1' => $path1]);
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();

            return redirect()->route('wb-admin.sample.index')->with('error_message', '商品の新規登録に失敗しました。');
        }

        return redirect()->route('wb-admin.sample.index')->with('success_message', '商品の新規登録に成功しました。');
    }

    /**
     * 編集画面表示
     *
     * @param integer $id
     * @return void
     */
    public function edit(int $id)
    {
        // 該当データ取得
        $post = Sample::find($id);
        if ($post === null) {
            return redirect()->route('wb-admin.sample.index')->with('error_message', '不適切なIDが設定されました。');
        }

        // 親カテゴリー取得
        $categories = $this->_getCategory();

        return view('admin.sample.edit', compact('post', 'categories'));
    }

    /**
     * 更新処理
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function postEdit(Request $request, int $id)
    {
        // バリデーション
        $validator = $this->_validator($request);
        if ($validator->fails()) {
            return redirect()->route('wb-admin.sample.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
        // データ更新処理
        try {
            DB::beginTransaction();
            // バリデーション済みデータの取得
            $validated = $validator->validated();
            unset($validated['file1']);
            if (!is_null($request->file('file1'))) {
                // 画像アップロード
                $validated['file_path1'] = $request->file('file1')->store($id, 'post');
                // 旧ファイル削除
                Storage::disk('post')->delete($request->input('file_path1'));

            }
            // データ更新
            Sample::where('id', $id)->update($validated);
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();

            return redirect()->route('wb-admin.sample.index')->with('error_message', '商品の更新登録に失敗しました。');
        }

        return redirect()->route('wb-admin.sample.index')->with('success_message', '商品の更新登録に成功しました。');
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
            'category_id' => 'required',
            'name' => 'required',
            'file1' => 'required_without:file_path1|file|image:jpeg,png,jpg,gif',
        ],
            [
                'name.required' => '商品名は必ず指定してください。',
            ]);

        return $validator;
    }

    /**
     * 商品カテゴリーの取得
     *
     * @return mixed
     */
    private function _getCategory()
    {
        $categories = Category::select('id', 'name')->orderBy('sequence', 'DESC')->get();
        $select=['' => '選択してください'];
        foreach ($categories as $category) {
            $select[$category->id] = $category->name;
        }

        return $select;
    }
}

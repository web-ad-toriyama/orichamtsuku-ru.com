<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Sample;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CategoryController extends Controller
{
    /**
     * 一覧画面表示
     *
     * @return void
     */
    public function index()
    {
        // データ取得
        $categories = Category::orderBy('sequence', 'DESC')->paginate(config('custom.paginate.admin'));

        foreach ($categories as $index => $category) {
            $post1 = Sample::where('category_id', $category['id'])->first();
            $post2 = Template::where('category_id', $category['id'])->first();
            if ($post1 || $post2) {
                $categories[$index]['related_flg'] = true;
            } else {
                $categories[$index]['related_flg'] = false;
            }
        }

        return view('admin.category.index', compact('categories'));
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
                Storage::disk('category')->deleteDirectory($id);
                // データ削除
                Category::destroy($id);
            }
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('wb-admin.category.index')->with('error_message', 'データの削除に失敗しました。');
        }

        return redirect()->route('wb-admin.category.index')->with('success_message', 'データの削除に成功しました。');
    }

    /**
     * 一覧画面表示（並び替え用）
     *
     * @return void
     */
    public function sort()
    {
        // データ取得
        $categories = Category::orderBy('sequence', 'DESC')->get();

        return view('admin.category.sort', compact('categories'));
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
            return redirect()->route('wb-admin.category.index')->with('error_message', 'データの並び替えが行われていません。');
        }

        $index = count($request->input('id'));

        try {
            DB::beginTransaction();
            foreach ($request->input('id') as $id) {
                Category::where('id', $id)->update(['sequence' => $index]);
                $index--;
            }
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('wb-admin.category.index')->with('error_message', 'データの並び替えに失敗しました。');
        }

        return redirect()->route('wb-admin.category.index')->with('success_message', 'データの並び替えに成功しました。');
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
        $category = Category::find($id);
        $display = config('custom.display.on');
        if ($category->display ==  config('custom.display.on')) {
            $display = config('custom.display.off');
        }

        try {
            Category::where('id', $category->id)->update(['display' => $display]);
            // 非表示に変更する場合、紐づく商品も非表示に変更する
            if ($display === config('custom.display.off')) {
                Post::where('category_id', $id)->update(['display' => $display]);
            }
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.category.index', ['page'=>$request->get('page')])->with('error_message', '表示状態の変更に失敗しました。');
        }

        return redirect()->route('wb-admin.category.index', ['page'=>$request->get('page')])->with('success_message', '表示状態の変更に成功しました。');
    }

    /**
     * 登録画面表示
     *
     * @return void
     */
    public function add()
    {
        return view('admin.category.add');
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
            return redirect()->route('wb-admin.category.add')
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
            $validated['sequence'] = Category::max('sequence')+1;
            // 新規登録処理
            $category = Category::create($validated);
            // 画像アップロード
//            Storage::disk('category')->makeDirectory($category->id);
//            $path = $request->file('file')->store($category->id, 'category');
            // データ更新
//            Category::where('id', $category->id)->update(['file_path' => $path]);
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();

            return redirect()->route('wb-admin.category.index')->with('error_message', '新規登録に失敗しました。');
        }

        return redirect()->route('wb-admin.category.index')->with('success_message', '新規登録に成功しました。');
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
        $category = Category::find($id);
        if ($category === null) {
            return redirect()->route('wb-admin.category.index')->with('error_message', '不適切なIDが設定されました。');
        }

        return view('admin.category.edit', compact('category'));
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
            return redirect()->route('wb-admin.category.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
        // データ更新処理
        try {
            DB::beginTransaction();
            // バリデーション済みデータの取得
            $validated = $validator->validated();
//            unset($validated['file']);
//            if (!is_null($request->file('file'))) {
//                // 画像アップロード
//                $validated['file_path'] = $request->file('file')->store($id, 'category');
//                // 旧ファイル削除
//                Storage::disk('category')->delete($request->input('file_path'));
//            }
            // データ更新
            Category::where('id', $id)->update($validated);
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();

            return redirect()->route('wb-admin.category.index')->with('error_message', '更新登録に失敗しました。');
        }

        return redirect()->route('wb-admin.category.index')->with('success_message', '更新登録に成功しました。');
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
            'name' => 'required',
//            'file' => 'required_without:file_path|file|image:jpeg,png,jpg,gif',
//            'contents' => 'required',
        ],
            [
                'name.required' => 'カテゴリー名は必ず指定してください。',
                'contents.required'  => '説明文は必ず指定してください。',
            ]);

        return $validator;
    }
}

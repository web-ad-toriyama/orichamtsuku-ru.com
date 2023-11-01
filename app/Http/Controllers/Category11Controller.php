<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Category;

class Category11Controller extends Controller
{
    public function index()
    {

        $categories = Category::select('id', 'name')->orderBy('sequence', 'DESC')->get();
        $select=['' => '選択してください'];
        foreach ($categories as $category) {
            $select[$category->id] = $category->name;
        }

        // お知らせ一覧取得
        $templates = Template::where('display', config('custom.display.on'))
            ->orderBy('id', 'DESC')
            ->paginate(config('custom.paginate.news'));

        return view('category11', compact('templates','select'));
    }
}

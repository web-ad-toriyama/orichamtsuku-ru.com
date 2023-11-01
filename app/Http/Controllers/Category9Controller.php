<?php

namespace App\Http\Controllers;

use App\Models\Production;

class Category9Controller extends Controller
{
    public function index()
    {
        // お知らせ一覧取得
        $news = Production::where('display', config('custom.display.on'))
            ->orderBy('published_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(config('custom.paginate.news'));

        return view('category9', compact('news'));
    }
}

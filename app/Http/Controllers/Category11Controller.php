<?php

namespace App\Http\Controllers;

use App\Models\Template;

class Category11Controller extends Controller
{
    public function index()
    {
        // お知らせ一覧取得
        $templates = Template::where('display', config('custom.display.on'))
            ->orderBy('id', 'DESC')
            ->paginate(config('custom.paginate.news'));

        return view('category11', compact('templates'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Sample;

class Category12Controller extends Controller
{
    public function index()
    {
        // お知らせ一覧取得
        $samples = Sample::where('display', config('custom.display.on'))
            ->orderBy('id', 'DESC')
            ->paginate(config('custom.paginate.news'));

        return view('category12', compact('samples'));
    }
}

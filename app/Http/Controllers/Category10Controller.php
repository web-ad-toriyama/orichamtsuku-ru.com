<?php

namespace App\Http\Controllers;

use App\Models\Voice;

class Category10Controller extends Controller
{
    public function index()
    {
        // お知らせ一覧取得
        $voices = Voice::where('display', config('custom.display.on'))
            ->orderBy('published_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(config('custom.paginate.voice'));

        return view('category10', compact('voices'));
    }
}

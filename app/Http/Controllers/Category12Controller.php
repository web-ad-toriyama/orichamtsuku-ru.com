<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sample;

class Category12Controller extends Controller
{
    public function index($category_id=null)
    {
        $categories = Category::select('id', 'name')->orderBy('sequence', 'DESC')->get();
        $select=['' => '選択してください'];
        foreach ($categories as $category) {
            $select[$category->id] = $category->name;
        }

        if($category_id){
            $samples = Sample::where('display', config('custom.display.on'))
                ->where('category_id', $category_id)
                ->orderBy('id', 'DESC')
                ->paginate(config('custom.paginate.template'));
        }else{
            $samples = Sample::where('display', config('custom.display.on'))
                ->orderBy('id', 'DESC')
                ->paginate(config('custom.paginate.template'));
        }

        return view('category12', compact('samples','select','category_id'));
    }
}

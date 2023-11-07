<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Category;

class Category11Controller extends Controller
{
    public function index($category_id=null)
    {

        $categories = Category::select('id', 'name')->orderBy('sequence', 'DESC')->get();
        $select=['' => '選択してください'];
        foreach ($categories as $category) {
            $select[$category->id] = $category->name;
        }

        if($category_id){
            $templates = Template::where('display', config('custom.display.on'))
                ->where('category_id', $category_id)
                ->orderBy('id', 'DESC')
                ->paginate(config('custom.paginate.template'));
        }else{
            $templates = Template::where('display', config('custom.display.on'))
                ->orderBy('id', 'DESC')
                ->paginate(config('custom.paginate.template'));
        }

        return view('category11', compact('templates','select','category_id'));
    }
}

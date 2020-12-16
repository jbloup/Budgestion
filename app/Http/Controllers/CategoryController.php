<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('create/create_category',[
            'categories' => Category::all(),
            'message_success' => ""
        ]);
    }


    public function store()
    {
        request()->validate([
            'name' => ['unique','required', 'string'],
            'description' => ['required', 'string']
        ]);
        Category::create([
            'name' => request('name'),
            'description' => request('description'),

        ]);

        return view('create/create_category',[
            'message_success' => "catégorie bien enregistrée",
            'categories' => Category::all()
        ]);
    }

}

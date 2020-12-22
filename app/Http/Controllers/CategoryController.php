<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ]);
        Category::create([
            'name' => request('name'),
            'description' => request('description'),
            'user_id' => Auth::user()->getAuthIdentifier()

        ]);

        return view('create/create_category',[
            'message_success' => "catégorie bien enregistrée",
            'categories' => Category::all()
        ]);
    }

}

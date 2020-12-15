<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function create()
    {
        request()->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);
        $category = Category::create([
            'name' => request('name'),
            'description' => request('description'),

        ]);

        return "La " . $category . " est bien enregistrée";
    }
}

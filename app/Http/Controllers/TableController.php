<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    public function month(){

        setlocale(LC_TIME, "fr_FR");

        return view('table/month',[
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'month' => strftime("%B"),
        ]);
    }
    public function year(){

        return view('table/year',[
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'year' => strftime("%G"),
        ]);
    }
}

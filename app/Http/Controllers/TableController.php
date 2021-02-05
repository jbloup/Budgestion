<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Spent;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    public function view(){

        return view('table/month',[
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'spents' => Spent::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Spent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    public function show(){

        return view('table/spent_per_month',[
            'spents' => Spent::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
        ]);
    }
}

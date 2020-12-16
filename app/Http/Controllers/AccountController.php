<?php

namespace App\Http\Controllers;


use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function create()
    {
        request()->validate([
            'name' => ['required', 'string'],
            'number' => ['required', 'integer'],
            'description' => ['string'],
            'amount' => ['required', 'integer'],
            'user_id' => ['required', 'integer']
        ]);
        $car = Account::create([
            'name' => request('name'),
            'number' => request('number'),
            'description' => request('description'),
            'amount' => request('amount'),
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

    }
}

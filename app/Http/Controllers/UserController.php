<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * welcome !
     *
     * @return Application|Factory|View
     */
    public function view()
    {
        $users = User::where('id', Auth::user()->getAuthIdentifier())->get();

        foreach ($users as $user)

        return view('auth/profil',[
            'user' => $user,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * welcome !
     *
     * @return Application|Factory|View
     */

    public function home()
    {
        $users = User::where('id', Auth::user()->getAuthIdentifier())->get();

        foreach ($users as $user){
            $user_name = $user->name;
        }

        return view('/home',[
            'user_name' => $user_name,
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->where('kind', 'spent')->get(),
            'accounts' => Account::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('main', 'desc')->get()
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function welcome() {

        return view('welcome');
    }
}

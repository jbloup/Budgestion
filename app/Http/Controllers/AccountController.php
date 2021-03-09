<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Show the Form to create a new account
     *
     * @return Application|Factory|View
     */
    public function view()
    {

        return view('create.account',[
            'accounts' => Account::where('user_id', Auth::user()->getAuthIdentifier())->get(),
        ]);
    }

    /**
     * Create a new account
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'number' => 'unique:accounts,number|required|integer',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'main' => 'required'
        ]);

        if (request('main') == 1){
            Account::where('user_id', Auth::user()->getAuthIdentifier())->update(['main' => 0]);
        }

        Account::create([
            'name' => request('name'),
            'number' => request('number'),
            'description' => request('description'),
            'amount' => number_format(request('amount'), 2, '.', ''),
            'main' => request('main'),
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return back()->with('create', 'compte ajouté');
    }

    /**
     * Update a account
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'update_name' => 'required|string',
            'update_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'update_main' => 'required'
        ]);

        if (request('update_main') == 1){
            Account::where('user_id', Auth::user()->getAuthIdentifier())->update(['main' => 0]);
        }

        $accountNumber = DB::table('accounts' )->select('number')->where('user_id', Auth::user()->getAuthIdentifier())->where('id', $id)->get();

        if (request('update_number') != $accountNumber ){
            Account::where('id', $id)
                ->update([
                    'name' => request('update_name'),
                    'number' => request('update_number'),
                    'description' => request('update_description'),
                    'amount' => number_format(request('update_amount'), 2, '.', ''),
                    'main' => request('update_main')
                ]);

        }else{
            Account::where('id', $id)
                ->update([
                    'name' => request('update_name'),
                    'description' => request('update_description'),
                    'amount' => request('update_amount'),
                    'main' => request('update_main')
                ]);
        }

        return back()->with('update', 'compte modifié');
    }

    /**
     * Delete a account
     *
     * @param $id
     * @return RedirectResponse
     */

    public function delete($id)
    {
        Account::where('id', $id)->delete();

        return back()->with('delete', 'compte supprimé');
    }
}

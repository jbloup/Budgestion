<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Family;
use App\Models\Spent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SpentController extends Controller {

    /**
     * Show the form to create a new spent
     *
     * @return Application|Factory|View
     */

    public function create()
    {
        return view('create/create_spent',[
            'spents' => Spent::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
            'families' => Family::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'accounts' => Account::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('main', 'desc')->get(),
            'message_success' => "",
            'message_updated' => "",
        ]);
    }

    /**
     * Create a new spent
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'date' => 'required|date|date_format:d-m-Y',
            'family_id' => 'required|integer',
            'account_id' => 'required|integer'
        ]);

        Spent::create([
                'name' => request('name'),
                'description' => request('description'),
                'price' => request('price'),
                'date' => date('Y-m-d', strtotime(request('date'))),
                'user_id' => Auth::user()->getAuthIdentifier(),
                'account_id' => request('account_id'),
                'family_id' => request('family_id'),
        ]);

        return view('create/create_spent',[
            'spents' => Spent::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
            'families' => Family::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'accounts' => Account::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('main', 'desc')->get(),
            'message_success' => "dépense bien enregistrée",
            'message_updated' => "",
        ]);
    }

    /**
     * Update a spent
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function update(Request $request)
    {
        $request->validate([
            'update_spent_name' => 'required|string|max:255',
            'update_spent_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'update_spent_date' => 'required|date|date_format:d-m-Y',
            'update_account_id' => 'required|integer',
            'update_family_id' => 'required|integer',
        ]);

        Spent::where('id', request('spent_id'))
            ->update([
                'name' => request('update_spent_name'),
                'description' => request('update_spent_description'),
                'price' => request('update_spent_price'),
                'date' => date('Y-m-d', strtotime(request('update_spent_date'))),
                'user_id' => Auth::user()->getAuthIdentifier(),
                'account_id' => request('update_account_id'),
                'family_id' => request('update_family_id'),

            ]);

        return view('create/create_spent',[
            'spents' => Spent::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
            'families' => Family::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'accounts' => Account::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('main', 'desc')->get(),
            'message_updated' => "modification bien enregistrée",
            'message_success' => "",
        ]);
    }

    /**
     * Delete a spent
     *
     * @return Application|Factory|View
     */
    public function delete()
    {
        DB::table('spents')->where('id', request('spent_id'))->delete();

        return view('create/create_spent',[
            'spents' => Spent::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
            'families' => Family::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'accounts' => Account::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('main', 'desc')->get(),
            'message_updated' => "",
            'message_success' => "",
        ]);
    }
}

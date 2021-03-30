<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Earning;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EarningController extends Controller
{
    /**
     * Show the form to create a new earning
     *
     * @return Application|Factory|View
     */
    public function view()
    {
        return view('create.earning',[
            'earnings' => Earning::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->limit(50)->get(),
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->where('kind', 'earning')->get(),
            'accounts' => Account::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('main', 'desc')->get(),
        ]);
    }

    /**
     * Create a new earning
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'date' => 'required|date',
            'family_id' => 'required|integer',
            'account_id' => 'required|integer'
        ]);

        Earning::create([
            'name' => request('name'),
            'description' => request('description'),
            'amount' => request('amount'),
            'date' => date('Y-m-d', strtotime(request('date'))),
            'user_id' => Auth::user()->getAuthIdentifier(),
            'account_id' => request('account_id'),
            'family_id' => request('family_id'),
        ]);

        return back()->with('toast_success', 'Revenu ajouté !');
    }

    /**
     * Update a earning
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'update_earning_name' => 'required|string|max:255',
            'update_earning_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'update_earning_date' => 'required|date|date_format:d-m-Y',
            'update_account_id' => 'required|integer',
            'update_family_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Earning::where('id', $id)
            ->update([
                'name' => request('update_earning_name'),
                'description' => request('update_earning_description'),
                'amount' => request('update_earning_amount'),
                'date' => date('Y-m-d', strtotime(request('update_earning_date'))),
                'user_id' => Auth::user()->getAuthIdentifier(),
                'account_id' => request('update_account_id'),
                'family_id' => request('update_family_id'),

            ]);

        return back()->with('toast_success', 'Revenu modifié !');
    }

    /**
     * Delete a earning
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        DB::table('earnings')->where('id', $id)->delete();

        return back()->with('toast_success', 'Revenu supprimé !');
    }
}

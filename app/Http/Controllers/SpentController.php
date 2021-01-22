<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Family;
use App\Models\Spent;
use http\Env\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SpentController extends Controller
{
    public function create()
    {
        return view('create/create_spent',[
            'sspents' => DB::table('spents')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'families' => DB::table('families')
                ->leftJoin('types', 'families.type_id', '=', 'types.id')
                ->leftJoin('users', 'types.user_id', '=', 'users.id')
                ->select('families.name', 'families.id')
                ->where('users.id', Auth::user()->getAuthIdentifier())
                ->get(),
            'accounts' => DB::table('accounts')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_success' => "",
            'message_updated' => "",
            'e' => "",
            'select' => DB::table('families')
                ->join('spents', 'spents.family_id', '=', 'families.id')
                ->join('categories', 'spents.category_id', '=', 'categories.id')
                ->select('families.name', 'spents.price', 'spents.date', 'spents.description', 'categories.name')
        ->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'date' => 'required|date|date_format:Y-m-d',
            'category_id' => 'required|integer',
            'family_id' => 'required|integer',
            'account_id' => 'required|integer'
        ]);

        try{

            $e = "";
        Spent::create([
                'name' => request('name'),
                'description' => request('description'),
                'price' => request('price'),
                'date' => request('date'),
                'user_id' => Auth::user()->getAuthIdentifier(),
                'account_id' => request('account_id'),
                'category_id' => request('category_id'),
                'family_id' => request('family_id'),
        ]);
        }catch(\Exception $error){
            $e = $error;
    }

        return view('create/create_spent',[
            'sspents' => DB::table('spents')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'families' => DB::table('families')->get(),
            'accounts' => DB::table('accounts')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_success' => "dépense bien enregistrée",
            'message_updated' => "",
            'e' => $e
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function update(Request $request)
    {
        $request->validate([
            'update_name' => 'required|string|max:255',
            'update_price' => 'required|decimal',
            'update_date' => 'required|date',
            'update_account_id' => 'required|integer',
            'update_category_id' => 'required|integer',
            'update_family_id' => 'required|integer',
        ]);

        Spent::where('id', request('spent_id'))
            ->update([
                'name' => request('update_name'),
                'description' => request('update_description'),
                'price' => request('update_price'),
                'date' => request('update_date'),
                'user_id' => Auth::user()->getAuthIdentifier(),
                'account_id' => request('update_account_id'),
                'category_id' => request('update_category_id'),
                'family_id' => request('update_family_id'),

            ]);

        return view('create/create_spent',[
            'sspents' => DB::table('spents')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'families' => DB::table('families')->get(),
            'accounts' => DB::table('accounts')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_updated' => "modification bien enregistrée",
            'message_success' => "",
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function delete()
    {
        DB::table('spents')->where('id', request('car_id'))->delete();

        return view('create/create_spent',[
            'sspents' => DB::table('spents')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'families' => DB::table('families')->get(),
            'accounts' => DB::table('accounts')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_updated' => "",
            'message_success' => "",
        ]);
    }
}

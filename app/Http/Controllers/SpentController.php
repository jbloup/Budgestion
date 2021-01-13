<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Spent;
use App\Models\Type;
use http\Env\Response;
use http\Exception;
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
            'spents' => DB::table('spents')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'categories' => DB::table('categories')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'types' => DB::table('types')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'accounts' => DB::table('accounts')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_success' => "",
            'message_updated' => "",
            'e' => "",
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
            'description' => 'string|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'date' => 'required|date|date_format:Y-m-d',

            'category_id' => 'required|integer',
            'type_id' => 'required|integer',

        ]);

        $date2 = request('date')->format('Y-m-d');
        $date = "2020-10-12";

        $error = "";
        try {
            Spent::create([
                'name' => "name",
                'description' => "truc",
                'price' =>13,
                'date' => $date,
                'user_id' => Auth::user()->getAuthIdentifier(),
                'account_id' => 1,
                'category_id' => 1,
                'type_id' => 1,
                'families_id' => 1,
            ]);
        }catch (\Exception $e){
            $error = $e;
        }
        return view('create/create_spent',[
            'spents' => DB::table('spents')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'categories' => DB::table('categories')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'types' => DB::table('types')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'accounts' => DB::table('accounts')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_success' => "dépense bien enregistrée",
            'message_updated' => "",
            'e' => $error,
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
            'update_description' => 'required|string|max:255',
            'update_price' => 'required|decimal',
            'update_date' => 'required|date',
            'update_account_id' => 'required|integer',
            'update_category_id' => 'required|integer',
            'update_family_id' => 'required|integer',
        ]);

        Spent::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', request('spent_id'))
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
            'spents' => DB::table('spents')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'categories' => DB::table('categories')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'types' => DB::table('types')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
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
            'spents' => DB::table('spents')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'categories' => DB::table('categories')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'types' => DB::table('types')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'accounts' => DB::table('accounts')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_updated' => "",
            'message_success' => "",
        ]);
    }

    public function getFamilies($typeId)
    {
        $dataFamily = DB::table('families')->where('type_id', $typeId)->get();

        return Response::json($dataFamily);
    }

}

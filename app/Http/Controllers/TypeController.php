<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Type;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    /**
     * Show the form to create a new type.
     *
     */
    public function create()
    {
        return view('create/create_type',[
            'types' => Type::all(),
            'families' => Family::all(),
            'message_success' => "",
            'message_success_family' => ""
        ]);
    }

    /**
     * Store a new type.
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'unique:types,name|required|string|max:255',
            'type_description' => 'required|string|max:255',
        ]);

        Type::create([
           'name'=>request('type_name'),
           'description'=>request('type_description'),
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return view('create/create_type',[
            'types' => DB::table('types')->where('user_id', Auth::user()->getAuthIdentifier()),
            'families' => Family::all(),
            'message_success_family' => "",
            'message_success' => "type bien enregistré"
        ]);
    }
}



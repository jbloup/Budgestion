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
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TypeController extends Controller
{
    /**
     * Show the form to create a new type.
     *
     */
    public function create()
    {
        $types = Type::where('user_id', Auth::user()->getAuthIdentifier())->get();

        return view('create/create_type',[
            'types' => $types,
            'message_success' => "",
            'message_success_family' => "",
            'message_updated' => "",
        ]);
    }

    /**
     * Store a new type.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
        ]);

        Type::create([
           'name'=>request('type_name'),
           'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        $types = Type::where('user_id', Auth::user()->getAuthIdentifier())->get();

        return view('create/create_type',[
            'types' => $types,
            'message_success_family' => "",
            'message_success' => "type bien enregistré",
            'message_updated' => "",
        ]);
    }
    /**
     * Store a new type.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function update(Request $request)
    {
        $request->validate([
            'update_name' => 'required|string|max:255',
        ]);

        Type::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', request('type_id'))
            ->update(['name' => request('update_name')]
            );

        $types = Type::where('user_id', Auth::user()->getAuthIdentifier())->get();

        return view('create/create_type',[
            'types' => $types,
            'message_updated' => "modification bien enregistrée",
            'message_success' => "",
            'message_success_family' => "",
        ]);
    }

    /**
     * Store a new type.
     * @param
     * @return Application|Factory|View
     */
    public function delete()
    {
        DB::table('types')->where('id', request('type_id'))->delete();

        $types = Type::where('user_id', Auth::user()->getAuthIdentifier())->get();

        return view('create/create_type',[
            'types' => $types,
            'message_updated' => "",
            'message_success' => "",
            'message_success_family' => "",
        ]);
    }
}



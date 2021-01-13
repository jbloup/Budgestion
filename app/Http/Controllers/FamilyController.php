<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Type;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FamilyController extends Controller
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
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        $request->validate([
            'family_name' => 'required|string|max:255',
            'family_type_id' => 'required',

        ]);

        Family::create([
            'name'=>request('family_name'),
            'type_id'=> request('family_type_id')
        ]);

        $types = Type::where('user_id', Auth::user()->getAuthIdentifier())->get();

        return view('create/create_type',[
            'types' => $types,
            'message_success' => "",
            'message_success_family' => "sous-type bien enregistré",
            'message_updated' => "",
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function update(Request $request)
    {
        $request->validate([
            'update_family_name' => 'required|string|max:255',
            'update_family_type_id' => 'required',
        ]);

        $types = Type::where('user_id', Auth::user()->getAuthIdentifier())->get();

        Family::where('id', request('family_id'))
            ->update(['name' => request('update_family_name'), 'type_id' => request('update_family_type_id')]
            );

        return view('create/create_type',[
            'types' => $types,
            'message_updated' => "modification bien enregistrée",
            'message_success' => "",
            'message_success_family' => "",
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function delete()
    {
        DB::table('families')->where('id', request('family_id'))->delete();

        $types = Type::where('user_id', Auth::user()->getAuthIdentifier())->get();

        return view('create/create_type',[
            'types' => $types,
            'message_updated' => "",
            'message_success' => "",
            'message_success_family' => "",
        ]);
    }
}

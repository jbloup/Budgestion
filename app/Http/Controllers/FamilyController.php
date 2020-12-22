<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Type;
use Illuminate\Http\Request;


class FamilyController extends Controller
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
     */
    public function store(Request $request)
    {
        $request->validate([
            'family_name' => 'unique:families,name|required|string|max:255',
            'family_description' => 'required|string|max:255',

        ]);

        Family::create([
            'name'=>request('family_name'),
            'description'=>request('family_description'),
            'type_id'=> $request->input('type_id')
        ]);

        return view('create/create_type',[
            'types' => Type::all(),
            'families' => Family::all(),
            'message_success' => "",
            'message_success_family' => "sous-type bien enregistré",
        ]);
    }
}

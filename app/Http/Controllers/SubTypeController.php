<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubTypeController extends Controller
{
    /**
     * Show the form to create a new type.
     *
     */
    public function create()
    {
        return view('create/create_type');
    }

    /**
     * Store a new type.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'type_id' => 'required',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function create()
    {
        return view('create/create_category',[
            'categories' => DB::table('categories')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_success' => "",
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        Category::create([
            'name' => request('name'),
            'description' => request('description'),
            'user_id' => Auth::user()->getAuthIdentifier()

        ]);

        return view('create/create_category',[
            'categories' => DB::table('categories')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_success' => "catégorie bien enregistrée",
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
            'update_description' => 'required|string|max:255',
        ]);

        Category::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', request('category_id'))
            ->update(['name' => request('update_name'), 'description' => request('update_description')]
            );

        return view('create/create_category',[
            'categories' => DB::table('categories')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_updated' => "modification bien enregistrée",
            'message_success' => "",
        ]);
    }

    /**
     * Store a new type.
     * @param
     * @return Application|Factory|View
     */
    public function delete()
    {
        DB::table('categories')->where('id', request('category_id'))->delete();

        return view('create/create_category',[
            'categories' => DB::table('categories')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_updated' => "",
            'message_success' => "",
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Kind;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Show the form to create a new type.
     *
     */
    public function view()
    {

        return view('create.category',[
            'kinds' => Kind::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'types' => Type::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
        ]);
    }

    /**
     * Store a new type.
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
            'type_category_id' => 'required|integer',
        ]);

        Type::create([
           'name'=>request('type_name'),
           'category_id'=>request('type_category_id'),
           'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return back()->with('create', 'Type ajouté');
    }

    /**
     * Store a new type.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'update_type_name' => 'required|string|max:255',
            'update_type_category_id' => 'required|integer',
        ]);

        Type::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', $id)
            ->update(['name' => request('update_type_name'), 'category_id'=>request('update_type_category_id'), ]
            );

        return back()->with('update', 'Type modifié');
    }

    /**
     * Store a new type.
     * @param
     * @return RedirectResponse
     */
    public function delete($id)
    {
        Type::where('id', $id)->delete();

        return back()->with('delete', 'Type supprimé');
    }
}



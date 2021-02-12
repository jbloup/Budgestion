<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function view()
    {
        return view('create/create_category',[
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'types' => Type::where('user_id', Auth::user()->getAuthIdentifier())->get(),
        ]);
    }

    /**
     * Creeate a new category
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request)
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

        return back()->with('create', 'catégorie ajoutée');
    }

    /**
     * Update a category
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'update_name' => 'required|string|max:255',
            'update_description' => 'required|string|max:255',
        ]);

        Category::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', $id)
            ->update(['name' => request('update_name'), 'description' => request('update_description')]
            );

        return back()->with('update', 'catégorie modifiée');
    }

    /**
     * Delete a category
     *
     * @param
     * @return RedirectResponse
     */
    public function delete($id)
    {
        Category::where('id', $id)->delete();

        return back()->with('delete', 'catégorie supprimée');
    }
}

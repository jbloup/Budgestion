<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function view()
    {
        return view('create.category',[
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
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
            'kind' => 'required|string|max:255'
        ]);

        Category::create([
            'name' => request('name'),
            'kind' => request('kind'),
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
            'update_kind' => 'required|string|max:255',
        ]);

        Category::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', $id)
            ->update(['name' => request('update_name'), 'kind' => request('update_kind')]
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

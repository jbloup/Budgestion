<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function view()
    {
        return view('create.category',[
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'spentCategories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->where('kind', 'spent')->get(),
            'earningCategories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->where('kind', 'earning')->get(),
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
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'category_kind' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Category::create([
            'name' => request('category_name'),
            'kind' => request('category_kind'),
            'user_id' => Auth::user()->getAuthIdentifier()

        ]);

        return back()->with('toast_success', 'Catégorie ajoutée');
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
        $validator = Validator::make($request->all(), [
            'update_category_name' => 'required|string|max:255',
            'update_category_kind' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Category::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', $id)
            ->update(['name' => request('update_category_name'), 'kind' => request('update_category_kind')]
            );

        return back()->with('toast_success', 'Catégorie modifiée');
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

        return back()->with('toast_success', 'Catégorie supprimée');
    }
}

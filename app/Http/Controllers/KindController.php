<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Kind;
use App\Models\Type;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KindController extends Controller
{
    /**
     * @return Application|Factory|View
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
     * Creeate a new category
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'kind_name' => 'required|string|max:255',
            'kind_description' => 'required|string|max:255'
        ]);

        Kind::create([
            'name' => request('kind_name'),
            'description' => request('kind_description'),
            'user_id' => Auth::user()->getAuthIdentifier()

        ]);

        return back()->with('create', 'type de revenu ajouté');
    }

    /**
     * Update a category
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'update_kind_name' => 'required|string|max:255',
            'update_kind_description' => 'required|string|max:255',
        ]);

        Kind::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', $id)
            ->update(['name' => request('update_kind_name'), 'description' => request('update_kind_description')]
            );

        return back()->with('update', 'type de revenu modifié');
    }

    /**
     * Delete a category
     *
     * @param
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Kind::where('id', $id)->delete();

        return back()->with('delete', 'type de revenu supprimé');
    }
}

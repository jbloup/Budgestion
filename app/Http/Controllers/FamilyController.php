<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Family;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    /**
     * Show the form to create a new type.
     *
     */
    public function view()
    {

        return view('create/create_category',[
            'types' => Type::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'family_name' => 'required|string|max:255',
            'family_type_id' => 'required',
        ]);

        Family::create([
            'name'=>request('family_name'),
            'user_id' => Auth::user()->getAuthIdentifier(),
            'type_id'=> request('family_type_id')
        ]);

        return back()->with('create', 'Sous-type ajouté');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'update_family_name' => 'required|string|max:255',
            'update_family_type_id' => 'required',
        ]);

        Family::where('id', $id)
            ->update(['name' => request('update_family_name'), 'type_id' => request('update_family_type_id')]
            );

        return back()->with('update', 'Sous-type modifié');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Family::where('id', $id)->delete();

        return back()->with('delete', 'Sous-type supprimé');
    }
}

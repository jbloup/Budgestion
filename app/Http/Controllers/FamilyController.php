<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Family;
use App\Models\Kind;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{
    /**
     * Show the form to create a new type.
     *
     */
    public function view()
    {

        return view('create.category',[
            'categories' => Category::where('user_id', Auth::user()->getAuthIdentifier())->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'family_name' => 'required|string|max:255',
            'family_type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Family::create([
            'name'=>request('family_name'),
            'user_id' => Auth::user()->getAuthIdentifier(),
            'type_id'=> request('family_type_id')
        ]);

        return back()->with('toast_success', 'Sous-type ajouté');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'update_family_name' => 'required|string|max:255',
            'update_family_type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Family::where('id', $id)
            ->update(['name' => request('update_family_name'), 'type_id' => request('update_family_type_id')]
            );

        return back()->with('toast_success', 'Sous-type modifié');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Family::where('id', $id)->delete();

        return back()->with('toast_success', 'Sous-type supprimé');
    }
}

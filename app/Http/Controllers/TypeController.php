<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Kind;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    /**
     * Show the form to create a new type.
     *
     */
    public function view()
    {

        return view('create.category',[
            'types' => Type::where('user_id', Auth::user()->getAuthIdentifier())->get(),
        ]);
    }

    /**
     * Store a new type.
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_name' => 'required|string|max:255',
            'type_category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Type::create([
           'name'=>request('type_name'),
           'category_id'=>request('type_category_id'),
           'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return back()->with('toast_success', 'Type ajouté');
    }

    /**
     * Store a new type.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'update_type_name' => 'required|string|max:255',
            'update_type_category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Type::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', $id)
            ->update(['name' => request('update_type_name'), 'category_id'=>request('update_type_category_id'), ]
            );

        return back()->with('toast_success', 'Type modifié');
    }

    /**
     * Store a new type.
     * @param
     * @return RedirectResponse
     */
    public function delete($id)
    {
        Type::where('id', $id)->delete();

        return back()->with('toast_success', 'Type supprimé');
    }
}



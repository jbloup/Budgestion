<?php

namespace App\Http\Controllers;

use App\Imports\CarsImport;
use App\Models\Car;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CarController extends Controller
{
    /**
     * Show the form to create a new Car
     *
     * @return Application|Factory|View
     */
    public function view()
    {
        return view('create.car',[
            'cars' => Car::where('user_id', Auth::user()->getAuthIdentifier())->get(),
        ]);
    }

    /**
     * Create a new car
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'mileage' => 'required|integer',
        ]);

        Car::create([
            'name' => request('name'),
            'fuel_type' => request('fuel_type'),
            'mileage' => request('mileage'),
            'user_id' => Auth::user()->getAuthIdentifier(),

        ]);

        return back()->with('toast_success', 'véhicule ajouté');
    }

    /**
     * Update a car
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'update_name' => 'required|string|max:255',
            'update_fuel_type' => 'required|string|max:255',
            'update_mileage' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Car::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', $id)
            ->update([
                    'name' => request('update_name'),
                    'fuel_type' => request('update_fuel_type'),
                    'mileage' => request('update_mileage')]
            );

        return back()->with('toast_success', 'véhicule modifié');
    }

    /**
     * Delete a car
     *
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function delete($id)
    {
        Car::where('id', $id)->delete();

        return back()->with('toast_success', 'véhicule supprimé');
    }

    /**
     * Import cars with excel file
     *
     * @return RedirectResponse
     */
    public function import()
    {
        Excel::import(new CarsImport, request()->file('import_file'));

        return back()->with('toast_success', 'véhicules importés');
    }
}

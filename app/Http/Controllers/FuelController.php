<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Fuel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuelController extends Controller
{
    /**
     * Show the form to create a new fuel
     *
     * @return Application|Factory|View
     */

    public function view()
    {
        return view('create.fuel',[
            'fuels' => Fuel::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
            'cars' => Car::where('user_id', Auth::user()->getAuthIdentifier())->get(),
        ]);
    }

    /**
     * Create a new fuel
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'liter' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mileage' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'date' => 'required|date',
            'car_id' => 'required|integer',
        ]);

        Fuel::create([
            'liter' => request('liter'),
            'price' => request('price'),
            'date' => date('Y-m-d', strtotime(request('date'))),
            'mileage' => request('mileage'),
            'user_id' => Auth::user()->getAuthIdentifier(),
            'car_id' => request('car_id'),
        ]);

        Car::where('id', request('car_id'))
        ->update(['mileage' => request('mileage'),]);

        return back()->with('create', 'dépense de carburant modifiée');
    }

    /**
     * Update a fuel
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'update_fuel_liter' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'update_fuel_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'update_fuel_date' => 'required|date',
            'update_fuel_mileage' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'update_car_id' => 'required|integer',
        ]);

        Fuel::where('id', $id)
            ->update([
                'liter' => request('update_fuel_liter'),
                'price' => request('update_fuel_price'),
                'date' => date('Y-m-d', strtotime(request('update_fuel_date'))),
                'mileage' => request('mileage'),
                'user_id' => Auth::user()->getAuthIdentifier(),
                'car_id' => request('update_car_id'),

            ]);

        Car::where('id', request('car_id'))
            ->update(['mileage' => request('mileage'),]);

        return back()->with('update', 'dépense de carburant modifiée');
    }

    /**
     * Delete a fuel
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        Fuel::where('id', $id)->delete();

        return back()->with('delete', 'dépense supprimée');
    }
}

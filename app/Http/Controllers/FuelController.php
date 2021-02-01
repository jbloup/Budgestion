<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Fuel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FuelController extends Controller
{
    /**
     * Show the form to create a new fuel
     *
     * @return Application|Factory|View
     */

    public function create()
    {
        return view('create/create_fuel',[
            'fuels' => Fuel::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
            'cars' => Car::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_success' => "",
            'message_updated' => "",
        ]);
    }

    /**
     * Create a new fuel
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        $request->validate([
            'liter' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'date' => 'required|date|date_format:d-m-Y',
            'car_id' => 'required|integer',
        ]);

        Fuel::create([
            'liter' => request('liter'),
            'price' => request('price'),
            'date' => date('Y-m-d', strtotime(request('date'))),
            'user_id' => Auth::user()->getAuthIdentifier(),
            'car_id' => request('car_id'),
        ]);

        return view('create/create_fuel',[
            'fuels' => Fuel::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
            'cars' => Car::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_success' => "dépense de carbburant bien enregistrée",
            'message_updated' => "",
        ]);
    }

    /**
     * Update a fuel
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function update(Request $request)
    {
        $request->validate([
            'update_fuel_liter' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'update_fuel_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'update_fuel_date' => 'required|date|date_format:d-m-Y',
            'update_car_id' => 'required|integer',
        ]);

        Fuel::where('id', request('fuel_id'))
            ->update([
                'liter' => request('update_fuel_liter'),
                'price' => request('update_fuel_price'),
                'date' => date('Y-m-d', strtotime(request('update_fuel_date'))),
                'user_id' => Auth::user()->getAuthIdentifier(),
                'car_id' => request('update_car_id'),

            ]);

        return view('create/create_fuel',[
            'fuels' => Fuel::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
            'cars' => Car::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_updated' => "modification bien enregistrée",
            'message_success' => "",
        ]);
    }

    /**
     * Delete a fuel
     *
     * @return Application|Factory|View
     */
    public function delete()
    {
        DB::table('fuels')->where('id', request('fuel_id'))->delete();

        return view('create/create_fuel',[
            'fuels' => Fuel::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(),
            'cars' => Car::where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_updated' => "",
            'message_success' => "",
        ]);
    }
}

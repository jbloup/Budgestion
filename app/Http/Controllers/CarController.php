<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{

    public function create()
    {
        return view('create/create_car',[
            'cars' => DB::table('cars')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_success' => "",
            'message_updated' => "",
        ]);
    }

    /**
     * Store a new type.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
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

        return view('create/create_car',[
            'cars' => DB::table('cars')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_success' => "voiture bien enregistrée",
            'message_updated' => "",
        ]);
    }

    /**
     * Store a new type.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function update(Request $request)
    {
        $request->validate([
            'update_name' => 'required|string|max:255',
            'update_fuel_type' => 'required|string|max:255',
            'update_mileage' => 'required|integer',
        ]);

        Car::where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', request('car_id'))
            ->update(['name' => request('update_name'), 'fuel_type' => request('update_fuel_type'),'mileage' => request('update_mileage')]
            );

        return view('create/create_car',[
            'cars' => DB::table('cars')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_updated' => "modification bien enregistrée",
            'message_success' => "",
        ]);
    }

    /**
     * Store a new type.
     * @param
     * @return Application|Factory|View
     */
    public function delete()
    {
        DB::table('cars')->where('id', request('car_id'))->delete();

        return view('create/create_car',[
            'cars' => DB::table('cars')->where('user_id', Auth::user()->getAuthIdentifier())->get(),
            'message_updated' => "",
            'message_success' => "",
        ]);
    }

}

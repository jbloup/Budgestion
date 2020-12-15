<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{

    public function create()
    {
        request()->validate([
            'name' => ['required', 'string'],
            'fuel_type' => ['required', 'string'],
            'mileage' => ['required', 'integer'],
            'user_id' => ['required', 'integer']
        ]);
        $car = Car::create([
            'name' => request('name'),
            'fuel_type' => request('fuel'),
            'mileage' => request('mileage'),
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return "La " . $car . " est bien enregistrée";
    }
}

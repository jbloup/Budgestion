<?php

namespace App\Imports;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class CarsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Car|null
     */
    public function model(array $row)
    {
        return new Car([
            'name' => $row[0],
            'fuel_type' => $row[1],
            'mileage' => $row[2],
            'user_id' => Auth::user()->getAuthIdentifier(),
        ]);
    }
}

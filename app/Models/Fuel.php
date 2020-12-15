<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    public function car()
    {
        return $this->belongsTo('App\Models\Car');
    }

    public function spent()
    {
        return $this->belongsTo('App\Models\Spent');
    }
}

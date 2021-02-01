<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */

    protected $fillable = [

        'liter',
        'price',
        'date',
        'car_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function car()
    {
        return $this->belongsTo('App\Models\Car');
    }
}

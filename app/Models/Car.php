<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'fuel_type',
        'mileage',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function fuels()
    {
        return $this->hasMany(Fuel::class, 'car_id', 'id');
    }
}

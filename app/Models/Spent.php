<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spent extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function family()
    {
        return $this->belongsTo('App\Models\SubType');
    }

    public function fuels()
    {
        return $this->hasMany('App\Models\Fuel');
    }
}

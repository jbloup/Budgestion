<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function subtypes()
    {
        return $this->hasMany('App\Models\SubType');
    }
    public function families()
    {
        return $this->hasMany('App\Models\SubType');
    }
}

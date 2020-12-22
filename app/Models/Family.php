<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type_id'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }
    public function spents()
    {
        return $this->hasMany('App\Models\Spent');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */

    protected $fillable = [
        'name',
        'number',
        'description',
        'amount',
        'main',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function spents()
    {
        return $this->hasMany(Spent::class, 'account_id', 'id');
    }
}

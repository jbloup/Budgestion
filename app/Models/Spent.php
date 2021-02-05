<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spent extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'spents';

    protected $guarded = array();

    protected $fillable = [
        'name',
        'description',
        'price',
        'date',
        'user_id',
        'account_id',
        'family_id',

    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function family()
    {
        return $this->belongsTo('App\Models\Family');
    }

    public function fuels()
    {
        return $this->hasMany(Fuel::class, 'spent_id', 'id');
    }
}

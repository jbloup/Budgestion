<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'earnings';

    protected $guarded = array();

    protected $fillable = [
        'name',
        'description',
        'amount',
        'date',
        'user_id',
        'account_id',
        'kind_id',

    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function kind()
    {
        return $this->belongsTo('App\Models\Kind');
    }
}

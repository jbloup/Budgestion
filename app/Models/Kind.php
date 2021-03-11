<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'kinds';

    protected $guarded = array();

    protected $fillable = [
        'id',
        'name',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function earnings()
    {
        return $this->hasMany(Earning::class, 'kind_id', 'id');
    }
}

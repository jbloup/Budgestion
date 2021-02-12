<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'families';

    protected $guarded = array();

    protected $fillable = [
        'id',
        'name',
        'type_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function type()
    {
        return $this->belongsTo(Type::class)->withDefault();
    }

    public function spents()
    {
        return $this->hasMany(Spent::class, 'family_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'types';

    protected $guarded = array();

    protected $fillable = [
        'id',
        'name',
        'category_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function families()
    {
        return $this->hasMany(Family::class, 'type_id', 'id');
    }
}

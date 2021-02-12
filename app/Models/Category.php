<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'categories';

    protected $guarded = array();

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function types()
    {
        return $this->hasMany(Type::class, 'category_id', 'id');
    }
}

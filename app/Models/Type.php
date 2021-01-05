<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'user_id'
    ];

    public function families(): HasMany
    {
        return $this->hasMany(Family::class, 'type_id', 'id');
    }
}

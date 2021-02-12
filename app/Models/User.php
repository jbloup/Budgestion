<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class, 'user_id', 'id');
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'user_id', 'id');
    }

    public function fuels()
    {
        return $this->hasMany(Fuel::class, 'user_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'user_id', 'id');
    }

    public function types()
    {
        return $this->hasMany(Type::class, 'user_id', 'id');
    }

    public function families()
    {
        return $this->hasMany(Family::class, 'user_id', 'id');
    }

    public function spents()
    {
        return $this->hasMany(Spent::class, 'user_id', 'id');
    }
}

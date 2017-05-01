<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\HouseRole;
use App\Point;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the house role associated with the model.
     */
    public function houseRole()
    {
        return $this->hasOne(HouseRole::class, 'user_id');
    }

    /**
     * Get the sum of points associated with the model.
     */
    public function pointsSum()
    {
        return $this->hasMany(Point::class, 'receiver_id')->sum('points');
    }

    public function points()
    {
        return $this->hasMany(Point::class,'receiver_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'votes');
    }

    public function isHeadMaster()
    {
        return $this->houseRole->role_level == 100 ? true : false;
    }


}

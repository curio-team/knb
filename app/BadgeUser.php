<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\User;
use \App\Badge;
class BadgeUser extends Model
{
    protected $table = 'badge_user';

    public function users(){
        return $this->belongsTo(\App\User::class);
    }
    public function badges(){
        return $this->hasMany(\App\Badge::class);
    }
}

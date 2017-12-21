<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\BadgeUser;
class ApiBadgesUsersController extends Controller
{
    public function index()
    {
        $badgesUsers = DB::table('badge_user')
            ->selectRaw('*')
            ->join('badges', 'badges.id','=' ,'badge_user.badge_id')
            ->join('users', 'users.id' , '=' , 'badge_user.user_id')
            ->join('house_roles', 'house_roles.user_id' , '=' , 'badge_user.user_id')
            ->join('houses', 'houses.id' , '=' , 'house_roles.house_id')
            ->orderBy('received_at','DESC')
            ->limit(4)
            ->get();
        return $badgesUsers->values()->toArray();
    }
}

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
            ->get();
        $badgesUsers = $badgesUsers->sortByDesc('received_at');
        return $badgesUsers->values()->toArray();
    }
}

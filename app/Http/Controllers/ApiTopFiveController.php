<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ApiTopFiveController extends Controller
{
    public function getRanking($id)
    {
        $houseUsers = DB::table('house_roles')
            ->selectRaw('*')
            ->join('users','house_roles.user_id','=', 'users.id')
            ->where('house_roles.house_id','=',"$id")
            ->orderBy('points', 'DESC')
            ->get();
        return $houseUsers->values()->toArray();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * show
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(\App\User $user)
    {
        $badges = \App\Badge::all();
        return view('profile.show', [
            'user' => $user,
            'badges' => $badges]);
    }

    /**
     * getStudents
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudents() {
        return \App\User::with('badges')->get();
    }
  
    /**
     * getStudent
     *
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function getRanking($limit)
    {
        $users = \App\User::orderBy('points', 'desc')->take($limit)->get();
        foreach($users as &$user)
        {
            $user->houseId = $user->houseRole['house_id'];
        }
        return $users;
    }


    public function getStudent($id) {
        return \App\User::with('badges')->where('id', $id)->first();
    }
    /**
     * edit
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * changePassword
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        if($request->password == $request->password_confirmation)
        {
            $user = \App\User::find(\Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->update();
            return back()->with('success', 'Password changed succesfully...');
        } else {
            return back()->with('error', 'Passwords did not match');
        }
    }

    /**
     * callBack
     *
     * @return \Illuminate\Http\Response
     */
    public function callBack() {
        $user = \Auth::user();
        if (! count($user->houseRole) )
        {
            $house = \App\House::withCount('users')->orderBy('users_count')->first();

            \App\HouseRole::create(['user_id' => $user->id, 'house_id' => $house->id, 'role_level', '0']);
            \App\Point::assign($user->id, \App\Point::BENEFACTOR_REGISTER_SYSTEM);
            \App\Badge::assign($user->id, 1);
            $user->addPoints(\App\Point::BENEFACTOR_REGISTER_SYSTEM, true);
        }
        return redirect("/");
    }

}

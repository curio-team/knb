<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function show(\App\User $user)
    {
        return view('profile.show', ['user' => $user]);
    }

    public function getStudents() {
        return \App\User::getStudents();
    }

    public function getStudent($id) {
        return \App\User::with('badges')->where('id', $id)->first();
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function changePassword(Request $request)
    {
//        dd($request->all());
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

    public function callBack() {
        if (! count($this->houseRole) )
        {
            \App\HouseRole::create(['user_id' => $this->id, 'house_id' => mt_rand(1, 4), 'role_level', '0']);
            \App\Point::assign($this->id, \App\Point::BENEFACTOR_REGISTER_SYSTEM);
            $this->addPoints(\App\Point::BENEFACTOR_REGISTER_SYSTEM, true);
        }
        return redirect("/");
    }

}

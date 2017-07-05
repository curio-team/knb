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

}

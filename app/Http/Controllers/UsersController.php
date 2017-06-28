<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function getStudents() {
        return \App\User::getStudents();
    }

    public function getStudent($id) {
        return \App\User::with('badges')->where('id', $id)->first();
    }

}

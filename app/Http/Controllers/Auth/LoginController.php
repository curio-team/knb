<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request) {

        $user = \App\User::where('email', $request->email)->first();
        if (!$user)
        {
            $user = \App\User::create([
                'id'    => explode('@', $request->email)[0],
                'email' => $request->email,
                'type'  => 'teacher',
                'name'  => explode('@', $request->email)[0],
                'points' => 0
            ]);
        }

        \Auth::login($user);

        if (! count($user->houseRole) )
        {
            $house = \App\House::withCount('users')->orderBy('users_count')->first();

            \App\HouseRole::create(['user_id' => $user->id, 'house_id' => $house->id, 'role_level', '0']);
            \App\Point::assign($user->id, \App\Point::BENEFACTOR_REGISTER_SYSTEM);
            \App\Badge::assign($user->id, 1);

            $user->addPoints(\App\Point::BENEFACTOR_REGISTER_SYSTEM, true);

        }

        return redirect('/');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BadgesController extends Controller
{
    public function index()
    {
        return \App\Badge::all();
    }

    public function show($id)
    {
        return \App\Badge::findOrFail($id);
    }

    public function request(Request $request)
    {
        $badge_id = $request->badge;
        $user_id = $request->user;

        $badge = \App\Badge::find($badge_id);
        $user = \App\User::find($user_id);


        \Mail::to(['f.vangils@rocwb.nl', 'b.roos2@rocwb.nl', 't.lutt@rocwb.nl', 'e.boekhoudt@rocwb.nl'])
            ->send(new BadgeRequest($badge, $user));


    }

    public function toggle(Request $request)
    {

        $user = \App\User::find($request->student_id);
        $badge = \App\Badge::find($request->badge_id);
        $message = new \App\Message;
        $message->sender_id = null;
        $message->receiver_id = $user->id;

        if ( ! $user->badges->contains($badge->id) )
        {
            //assign badge
            \App\Badge::assign($user->id, $badge->id);
        } else
        {
            //deassign badge
            $user->badges()->detach($request->badge_id);
            $message->subject = "We took a badge from you.... :( "; // Implement message based on type here
            $message->content = "We took the badge $badge->name from you. Please consult your headmaster for further details...";
        }

        $message->save();

    }

}

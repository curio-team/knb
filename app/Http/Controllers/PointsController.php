<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllocatePointsRequest;
use Illuminate\Http\Request;

class PointsController extends Controller
{

    public function allocate(AllocatePointsRequest $request)
    {

        \DB::transaction(function() use ($request){

            \App\ScoreLog::write($request->user_id, [
                'reason'    => $request->reason,
                'points'    => $request->points,
                'type'      => $request->type
            ]);

            if ( $request->type == 'deassign' )
            {
                $request->points = -abs($request->points);
            }

            $user = \App\User::find($request->user_id);
            $user->points += intval($request->points);
            $user->save();

            echo json_encode(['name' => $user->name]);

        });


    }

    public static function allocateFromBulk($id, $data, $revert)
    {
        $type = $revert ? 'deassign' : 'assign';
        \App\ScoreLog::write($id, [
            'reason'    => $data['message'],
            'points'    => $data['points'],
            'type'      => $type
        ]);

        if ( $revert )
        {
            $data['points'] = -abs($data['points']);
        }

        $user = \App\User::find($id);

        $user->points += $data['points'];
        $user->save();

    }
}

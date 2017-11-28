<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class EventGoal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_goals';

    protected $fillable = ['title', 'view_partial', 'points_required', 'event_id', 'house_id'];

    /**
     * Get the event associated with the model.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the house associated with the model.
     */
    public function house()
    {
        return $this->belongsTo(House::class);
    }

    /**
     * Get the progress associated with the model.
     */
    public function getProgressPercentage()
    {
        // TODO: Check performance and perhaps optimize this
        // Get all the points collected during a certain period for a house
        $pointsQueryBuilder = DB::table('points')
            ->join('score_types', 'score_types.id', '=', 'points.score_type_id')
            ->where([
                ['points.created_at', '>=', $this->event->start_datetime],
                ['points.created_at', '<=', $this->event->end_datetime],
            ]);
        
        if($this->house){
            $pointsQueryBuilder->join('users', 'users.id', '=', 'points.receiver_id') // Needed to get house role
            ->join('house_roles', 'house_roles.user_id', '=', 'users.id') // Needed to get house
            ->join('houses', 'houses.id', '=', 'house_roles.house_id') // Needed to check house id with where
            ->where('houses.id', '=', $this->house->id);
        }
            
        $totalPointsDuringPeriod = $pointsQueryBuilder->sum('score_types.points');

        return $totalPointsDuringPeriod / $this->points_required * 100;
    }

}

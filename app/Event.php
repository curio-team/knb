<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    protected $fillable = ['title', 'view', 'start_datetime', 'end_datetime', 'headmaster_only'];

    /**
     * Get the goals associated with the model.
     */
    public function goals()
    {
        return $this->hasMany(EventGoal::class, 'event_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Carbon\Carbon;

class Message extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * Get the sender associated with the model.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }


    public function getTimeReceived()
    {
        $date = $this->created_at;
        $carbonDate = new Carbon($date);

        return $carbonDate->diffForHumans();
    }
}

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
     * Attach points to the model
     */
    public function attachPoints($points){
        $attachment = new Attachment;
        $attachment->message_id = $this->id;
        $attachment->type_id = Attachment::TYPE_POINTS;
        $attachment->points_id = $points->id;

        $this->attachments()->save($attachment);
    }

    /**
     * Get the sender associated with the model.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    /**
     * Get the attachments associated with the model.
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'message_id', 'id');
    }

    public function getTimeReceived()
    {
        $date = $this->created_at;
        $carbonDate = new Carbon($date);

        return $carbonDate->diffForHumans();
    }



}

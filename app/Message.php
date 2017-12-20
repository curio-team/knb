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
     * attachPoints
     * Attach points to the model
     *
     * @param mixed $points
     * @return \Illuminate\Http\Response
     */
    public function attachPoints($points){
        $attachment = new Attachment;
        $attachment->message_id = $this->id;
        $attachment->type_id = Attachment::TYPE_POINTS;
        $attachment->points_id = $points->id;

        $this->attachments()->save($attachment);
    }

    /**
     * sender
     * Get the sender associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * receiver
     *
     * @return \Illuminate\Http\Response
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    /**
     * attachments
     * Get the attachments associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'message_id', 'id');
    }

    /**
     * getTimeReceived
     *
     * @return \Illuminate\Http\Response
     */
    public function getTimeReceived()
    {
        $date = $this->created_at;
        $carbonDate = new Carbon($date);

        return $carbonDate->diffForHumans();
    }

    /**
     * unreadMessages
     *
     * @param mixed $user_id
     * @return \Illuminate\Http\Response
     */
    public static function unreadMessages($user_id)
    {

        return \App\Message::where('receiver_id', $user_id)
            ->where('read', 0)
            ->get();

    }
}

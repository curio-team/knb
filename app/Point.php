<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Point extends Model
{
    const BENEFACTOR_REGISTER_SYSTEM = 1;                   // For when you register and get some points
    const BENEFACTOR_TYPE_QUESTION_ASKED = 2;               // For when you ask a question
    const BENEFACTOR_TYPE_QUESTION_ANSWERED = 3;            // Answering a question
    const BENEFACTOR_TYPE_ANSWER_ACCEPTED = 4;              // Your answer got marked as accepted
    const BENEFACTOR_TYPE_COMMENTED = 5;                    // Commenting on a question
    const BENEFACTOR_TYPE_USER_ASSIGNED = null;             // When a teacher awards points to you
    const BENEFACTOR_TYPE_TOP_WEEKLY_COMMENTER = 6;         // Weekly points for top active commenter
    const BENEFACTOR_TYPE_TOP_WEEKLY_MOST_VOTED_FOR = 7;    // weekly points for most voted for
    const BENEFACTOR_TYPE_TOP_WEEKLY_ANSWERS = 8;           // Weekly point for most answers


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'points';
    protected $fillable = ['receiver_id', 'score_type_id'];

    /**
     * Get the score type associated with the model.
     */
    public function scoreType()
    {
        return $this->belongsTo(ScoreType::class, 'score_type_id');
    }

    /**
     * @return bool
     */
    public function isYours()
    {
        return Auth::user()->id == $this->receiver->id;
    }

    /**
     * Get the receiver associated with the model.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get the benefactor associated with the model.
     */
    public function benefactor()
    {
        return $this->belongsTo(User::class, 'benefactor_id');
    }

    /**
     * Get the benefactor name associated with the model.
     */
    public function benefactorName()
    {
        if($this->benefactor_type === self::BENEFACTOR_TYPE_USER_ASSIGNED){
            return $this->benefactor->name;
        }else{
            return "The System";
        }
    }

    public static function assign($userId, $type)
    {
        $points = \App\Point::create([
            'receiver_id' => $userId,
            'score_type_id' => $type
        ]);

        try
        {
            \DB::beginTransaction();

            $message = new \App\Message;
            $message->sender_id = null;
            $message->receiver_id = $userId;
            $message->subject = 'You received points for [TODO]'; // Implement message based on type here
            $message->content = 'You have received points for doing [TODO]. Congratulations!';
            $message->save();

            $message->attachPoints($points);

            // create the message
            \DB::commit();
        } catch (\Exception $e)
        {
            \DB::rollback();
        }
    }

    public static function deAssign($userId, $type)
    {
        $point = \App\Point::where('receiver_id', $userId)->where('score_type_id', $type)->limit(1);
        $point->delete();

        try
        {
            \DB::beginTransaction();

            $message = new \App\Message;
            $message->sender_id = null;
            $message->receiver_id = $userId;
            $message->subject = 'You lost points for [TODO]'; // Implement message based on type here
            $message->content = 'You have lost points for doing [TODO].';
            $message->save();

            // create the message
            \DB::commit();
        } catch (\Exception $e)
        {
            \DB::rollback();
        }
    }

}

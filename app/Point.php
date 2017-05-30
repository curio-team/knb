<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Point extends Model
{
    const BENEFACTOR_REGISTER_SYSTEM = 3;                   // For when you register and get some points
    const BENEFACTOR_TYPE_QUESTION_ASKED = 1;               // For when you ask a question
    const BENEFACTOR_TYPE_QUESTION_ANSWERED = 1;            // Answering a question
    const BENEFACTOR_TYPE_ANSWER_ACCEPTED = 3;              // Your answer got marked as accepted
    const BENEFACTOR_TYPE_COMMENTED = 1;                    // Commenting on a question
    const BENEFACTOR_TYPE_USER_ASSIGNED = null;             // When a teacher awards points to you
    const BENEFACTOR_TYPE_TOP_WEEKLY_COMMENTER = 2;         // Weekly points for top active commenter
    const BENEFACTOR_TYPE_TOP_WEEKLY_MOST_VOTED_FOR = 3;    // weekly points for most voted for
    const BENEFACTOR_TYPE_TOP_WEEKLY_ANSWERS = 2;           // Weekly point for most answers


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'points';

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

    public function assign()
    {

    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Point extends Model
{
    const BENEFACTOR_TYPE_SYSTEM = 1; // For when you register and get some points
    const BENEFACTOR_TYPE_QUESTION_ASKED = 2; // For when you ask a question
    const BENEFACTOR_TYPE_QUESTION_ANSWERED = 3; // Answering a question
    const BENEFACTOR_TYPE_COMMENTED = 4; // Commenting on a question
    const BENEFACTOR_TYPE_USER_ASSIGNED = 100; // When a teacher awards points to you

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
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use SoftDeletes;

    const TYPE_POINTS = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attachments';

    public function description(){
        switch ($this->type_id){
            case self::TYPE_POINTS:{
                return "x points"; // TODO: Make it show the points here by joining the scoretype model
                break;
            }
            default:{
                return 'Unknown attachment';
                break;
            }
        }
    }
}

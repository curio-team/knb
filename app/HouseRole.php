<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'house_roles';

    /**
     * Get the post associated with the model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tag associated with the model.
     */
    public function house()
    {
        return $this->belongsTo(House::class);
    }
}

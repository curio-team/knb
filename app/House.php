<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /**
     * The roles a member can have with this model.
     *
     * @var integer
     */
    const ROLE_LEVEL_MEMBER = 0;
    const ROLE_LEVEL_HEADMASTER = 100;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'houses';

    /**
     * Gets all houses ordered by points
     */
    public static function sortByPoints($limit = null)
    {

       $houses = \App\House::get();
       $houses = $houses->sortByDesc(function($house) {
          return $house->users->sum('points');
       });

       return $houses;

    }

    /**
     * Get the member roles associated with the model.
     */
    public function memberRoles()
    {
        return $this->hasMany(HouseRole::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'house_roles', 'house_id', 'user_id');
    }

    /**
     * Get the headMaster associated with the model.
     */
    public function headmaster()
    {
        return $this->memberRoles()->where('role_level', self::ROLE_LEVEL_HEADMASTER)->first()->user;
    }

    /**
     * Get the total sum of points from all members
     */
    private function pointsSum()
    {

        $houses =  $this->with('users.points')->where('id', $this->id)->get();
        $sum = 0;
        foreach($houses as $house)
        {
            foreach($house->users as $user)
            {

                    $sum += $user->points;

            }
        }

        return $sum;

    }

    public function thumbnail() {
        $thumb = "";

        switch($this->id) {
            case 1:
                $thumb = "s_serpents.png";
                break;
            case 2:
                $thumb = "db_dragons.png";
                break;
            case 3:
                $thumb = "r_ravens.png";
                break;
            case 4:
                $thumb = "v_vikings.png";
                break;
        }

        return asset("img/icons/houses/{$thumb}");
    }



}

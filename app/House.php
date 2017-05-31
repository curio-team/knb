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
        $sql = "SELECT SUM(`score_types`.`points`) as total, `houses`.`name` as name, `houses`.`id` as id
                FROM `points`
                INNER JOIN `score_types` ON `score_types`.`id` = `points`.`score_type_id`
                LEFT JOIN `users` ON `users`.`id` = `points`.`receiver_id`
                INNER JOIN `house_roles` ON `users`.id = `house_roles`.`user_id`
                INNER JOIN `houses` ON `house_roles`.`house_id` = `houses`.`id`
                GROUP BY name, id
                ORDER BY total DESC
                ";
         if ($limit)
         {
             $sql .= " LIMIT $limit";
         }

        return collect(\DB::select($sql));
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
    public function pointsSum()
    {

        $houses =  $this->with('users.points')->where('id', $this->id)->get();
        $sum = 0;
        foreach($houses as $house)
        {
            foreach($house->users as $user)
            {
                foreach($user->points as $points)
                {
                    $sum += $points->points;
                }
            }
        }

        return $sum;

    }



}

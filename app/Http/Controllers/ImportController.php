<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadCsvRequest;
use Excel;

class ImportController extends Controller
{
    public $duplicates = 0;
    public $imports = 0;

    public function __construct()
    {
    }

    private function stripAccents($stripAccents){
        return strtr($stripAccents,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }

    public function upload(UploadCsvRequest $request)
    {
        $file = $request->file('csv');

        Excel::load($file, function($reader)  {

            $results = $reader->select(['klas', 'studentnr', 'naam', 'email'])->get();

            $house_id = 1;
            foreach ($results as $result)
            {
                $id = 'D'.$result->studentnr;

                if ($house_id == 5)
                {
                    $house_id = 1;
                }

                if (\App\User::where('id', '=', $id)->exists())
                {
                   $this->duplicates++;
                } else
                {
                    $user = new \App\User;
                    $user->id = $id;
                    $user->name     = $this->stripAccents($result->naam);
                    $user->email        = $result->email;
                    $user->type = 'student';
                    $user->points = 0;
                    $user->save();
                    \App\HouseRole::create(['user_id' => $user->id, 'house_id' => $house_id, 'role_level', '0']);
                    \App\Point::assign($user->id, \App\Point::BENEFACTOR_REGISTER_SYSTEM);
                    $user->addPoints(\App\Point::BENEFACTOR_REGISTER_SYSTEM, true);
                    $this->imports++;

                }
                $house_id++;
            }



        });
        return back()->with('success', 'Import successful. ' . $this->imports . ' added.' . $this->duplicates . ' duplicates were found.');
    }

    public function singleRegistration(Request $request)
    {

        $user = new \App\User;
        $user->name     = $request->name;
        $user->studentnr = $request->studentnr;
        $user->email        = $request->email;
        $user->password     = bcrypt( $user->studentnummer );
        $user->save();

        \App\HouseRole::create(['user_id' => $user->id, 'house_id' => $request->house_id, 'role_level', '0']);
        \App\Point::assign($user->id, \App\Point::BENEFACTOR_REGISTER_SYSTEM);
        $user->addPoints(\App\Point::BENEFACTOR_REGISTER_SYSTEM, true);
        return back()->with('succes', 'User ' . $user->name . ' succesfully registered to the amohub.');
    }

}

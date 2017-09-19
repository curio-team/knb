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



    public function upload(UploadCsvRequest $request)
    {
        $file = $request->file('csv');

        Excel::load($file, function($reader)  {

            $results = $reader->select(['roepnaam', 'voorvoegsel', 'achternaam', 'studentnummer'])->get();


            foreach ($results as $result)
            {
                if (\App\User::where('studentnr', '=', $result->studentnummer)->exists())
                {
                   $this->duplicates++;
                } else
                {
                    $fullname = $result->roepnaam . ' ' . $result->voorvoegsel . ' ' . $result->achternaam;
                    $email = 'd' . $result->studentnummer . '@edu.rocwb.nl';

                    $house_id = mt_rand(1, 4);
                    $user = new \App\User;
                    $user->name     = $fullname;
                    $user->studentnr = $result->studentnummer;
                    $user->email        = $email;
                    $user->password     = \Hash::make( 'welkom' );
                    $user->save();
                    \App\HouseRole::create(['user_id' => $user->id, 'house_id' => $house_id, 'role_level', '0']);
                    \App\Point::assign($user->id, \App\Point::BENEFACTOR_REGISTER_SYSTEM);
                    $user->addPoints(\App\Point::BENEFACTOR_REGISTER_SYSTEM, true);
                    $this->imports++;
                }

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

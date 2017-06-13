<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadCsvRequest;
use Excel;

class ImportController extends Controller
{

    public function __construct()
    {
    }

    public function import()
    {

    }

    public function upload(UploadCsvRequest $request)
    {
        $file = $request->file('csv');

        Excel::load($file, function($reader){

            $results = $reader->select(['roepnaam', 'voorvoegsel', 'achternaam', 'studentnummer'])->get();

            foreach ($results as $result)
            {
                $fullname = $result->roepnaam . ' ' . $result->voorvoegsel . ' ' . $result->achternaam;
                $student = new \App\User;


            }

        });

    }

}

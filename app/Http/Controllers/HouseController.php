<?php

namespace App\Http\Controllers;

use App\Events\HousesSelected;
use Illuminate\Http\Request;
use App\House;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        return view('houses.index', [
            'houses' => House::with('headmaster', 'headmaster.user')->get(),
        ]);
    }

    /**
     * Display the house selection page
     *
     * @return mixed
     */
    public function selection()
    {
        $thumbnail = \Auth::user()->houseRole->house->thumbnail();
        return view('houses.selection', compact('thumbnail'));
    }

    /**
     * Initiate the house selection
     *
     * @return mixed
     */
    public function doSelection()
    {
        // TODO: Authorize user
        var_dump(event(new HousesSelected()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function show($id)
    {
        return view('houses.show')->with([
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function destroy($id)
    {
        //
    }
}

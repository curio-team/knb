<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('headmaster', [
            'except' => [
                'show',
            ]
        ]);
    }
    
    public function show($id)
    {
        $event = \App\Event::findOrFail($id);
        
        return view('events.customizations.' . $event->view, compact('event'));
    }
    
    // TODO: Write the other resource actions
}

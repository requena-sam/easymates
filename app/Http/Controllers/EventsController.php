<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventsController
{
    public function index()
    {
        return view('pages.events.index');
    }

    public function show(Event $event)
    {
        return view('pages.events.show', [
            'event' => $event
        ]);
    }

}

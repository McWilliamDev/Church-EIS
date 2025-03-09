<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventsModel;

class EventsCalendarController extends Controller
{
    public function EventsCalendar()
    {
        $data['header_title'] = "Events Calendar";
        // Fetch events from the database
        $data['events'] = EventsModel::all();
        return view('admin.events.events_calendar', $data);
    }
}

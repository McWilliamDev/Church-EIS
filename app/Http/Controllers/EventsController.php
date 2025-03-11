<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventsController extends Controller
{
    public function list()
    {
        $data['getRecord'] = EventsModel::getRecord();
        $data['header_title'] = "Event List";

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.events.list', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.events.list', $data);
            }
        }
    }
    public function add()
    {
        $data['header_title'] = "Add Events";
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.events.add', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.events.add', $data);
            }
        }
    }
    public function insert(Request $request)
    {
        $events = new EventsModel();
        $events->title = $request->title;
        $events->description = $request->description;
        $events->location = $request->location;
        $events->date = $request->date;
        $events->created_by = Auth::user()->id;

        if (!empty($request->file('featured_image'))) {
            $ext = $request->file('featured_image')->getClientOriginalExtension();
            $file = $request->file('featured_image');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename =  strtolower($randomStr) . '.' . $ext;
            $file->move('upload/featured/', $filename);

            $events->featured_image = $filename;
        }
        $events->save();

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/events/list')->with('success', 'Event Added Successfully');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/events/list')->with('success', 'Event Added Successfully');
            }
        }
    }

    public function edit($id)
    {
        $data['getRecord'] = EventsModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Event";

            if (Auth::check()) {
                if (Auth::user()->user_type == 'admin') {
                    return view('admin.events.edit', $data);
                } elseif (Auth::user()->user_type == 'user') {
                    return view('user.events.edit', $data);
                } else {
                    return redirect('admin/events/list')->with('error', 'Event Not Found');
                }
            } else {
                return redirect('login')->with('error', 'Please log in to edit the event');
            }
        } else {
            return redirect('admin/events/list')->with('error', 'Event Not Found');
        }
    }
    public function update(Request $request, $id)
    {
        $events = EventsModel::getSingle($id);
        $events->title = $request->title;
        $events->description = $request->description;
        $events->location = $request->location;
        $events->date = $request->date;
        if (!empty($request->file('featured_image'))) {
            $ext = $request->file('featured_image')->getClientOriginalExtension();
            $file = $request->file('featured_image');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename =  strtolower($randomStr) . '.' . $ext;
            $file->move('upload/featured/', $filename);

            $events->featured_image = $filename;
        }
        $events->save();

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/events/list')->with('success', 'Event Successfully Updated');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/events/list')->with('success', 'Event Successfully Updated');
            }
        }
    }
    public function delete($id)
    {
        // Fetch the event record
        $event = EventsModel::find($id);

        if ($event) {
            if (!empty($event->featured_image) && file_exists('upload/featured/' . $event->featured_image)) {
                unlink('upload/featured/' . $event->featured_image);
            }

            $event->delete();

            if (Auth::check()) {
                return redirect()->back()->with('success', 'Event deleted successfully.');
            }
        }
        return redirect()->back()->with('error', 'Event not found.');
    }

    public function getEvents()
    {
        $events = EventsModel::all();
        $formattedEvents = [];

        foreach ($events as $event) {
            $formattedEvents[] = [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->date,
                'description' => $event->description,
                'location' => $event->location,
                'featured_image' => $event->featured_image,
            ];
        }

        return response()->json($formattedEvents);
    }
    public function upcomingEvents()
    {
        $data['upcomingEvents'] = EventsModel::getUpcomingEvents();
        $data['header_title'] = "Upcoming Events";

        if (Auth::check() && Auth::user()->user_type == 'admin') {
            return view('admin.events.upcoming', $data);
        } else {
            return redirect('login')->with('error', 'Please log in to view upcoming events');
        }
    }
}

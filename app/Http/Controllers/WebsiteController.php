<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WebsiteController extends Controller
{
    // Homepage method
    public function home()
    {
        $ministryCount = DB::table('ministry')->where('is_delete', 0)->count();
        $eventCount = DB::table('events')
            ->where('date', '>', Carbon::now())
            ->where('date', '<=', Carbon::now()->addDays(15))
            ->count();
        $resourceCount = DB::table('church_resources')->where('is_delete', 0)->count();
        $announcements = DB::table('announcements')
            ->where('notice_date', '>=', Carbon::now())
            ->get();

        return view('website.home', compact('ministryCount', 'eventCount', 'resourceCount', 'announcements'));
    }

    // Ministry Page method
    public function ministry()
    {
        $ministry = DB::table('ministry')->get();
        return view('website.ministry', compact('ministry'));
    }

    // Events Page method
    public function event()
    {
        $today = Carbon::today();
        $nextTwoWeeks = $today->copy()->addDays(15);

        $events = DB::table('events')
            ->whereBetween('date', [$today, $nextTwoWeeks])
            ->orderBy('date', 'asc')
            ->get();

        return view('website.event', compact('events'));
    }
    public function resources()
    {
        $resources = DB::table('church_resources')
            ->where('is_delete', 0)
            ->get();

        return view('website.resources', ['resources' => $resources]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use App\Models\MembersModel;
use App\Models\User;
use App\Models\FinanceModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard';
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {

                $data['TotalAdmin'] = User::getTotalUser('admin');
                $data['TotalUser'] = User::getTotalUser('user');
                $data['TotalMembers'] = MembersModel::getTotalMembers();
                $data['reports'] = FinanceModel::with('member')->get();
                $data['upcomingEvents'] = EventsModel::getUpcomingEvents();
                $data['upcomingEventsCount'] = $data['upcomingEvents']->count();

                $memberStatusCounts = MembersModel::getMemberStatusCounts();
                $data['activeMembersCount'] = $memberStatusCounts['active'];
                $data['inactiveMembersCount'] = $memberStatusCounts['inactive'];

                return view('admin.dashboard', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.dashboard', $data);
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnnouncementModel;
use App\Models\User;
use App\Models\MembersModel;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendAnnouncementMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AnnouncementController extends Controller
{


    public function SendAnnouncement()
    {
        $data['members'] = MembersModel::where('is_delete', 0)->get();
        $data['header_title'] = 'Send Announcement';

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.announcements.send_announcement', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.announcements.send_announcement', $data);
            }
        }
    }

    public function SendAnnouncementUser(Request $request)
    {
        // Check if the "send to all" checkbox is checked
        if ($request->has('email_to_all')) {
            // Get all members
            $members = MembersModel::where('is_delete', 0)->get();
            foreach ($members as $member) {
                $member->description = $request->description;
                $member->send_subject = $request->subject;

                Mail::to($member->email)->send(new SendAnnouncementMail($member));
            }
        } elseif (!empty($request->member_id)) {
            // Send to the selected member
            $member = MembersModel::getSingle($request->member_id);
            if ($member) {
                $member->description = $request->description;
                $member->send_subject = $request->subject;

                Mail::to($member->email)->send(new SendAnnouncementMail($member));
            }
        }

        if (!empty(Auth::check())) {
            return redirect()->back()->with('success', "Announcement Email successfully sent");
        }
    }
    public function Announcement()
    {
        $data['getRecord'] = AnnouncementModel::getRecord();
        $data['header_title'] = 'Create Announcement';

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.announcements.create_announcement.list', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.announcements.create_announcement.list', $data);
            }
        }
    }

    public function AddAnnouncement()
    {
        $data['header_title'] = 'Add Announcement';

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.announcements.create_announcement.add', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.announcements.create_announcement.add', $data);
            }
        }
    }

    public function InsertAnnouncement(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'notice_date' => 'required|date|after_or_equal:today',
            'description' => 'required|string',
        ]);

        $announcement = new AnnouncementModel();
        $announcement->title = $request->title;
        $announcement->notice_date = $request->notice_date;
        $announcement->description = $request->description;
        $announcement->created_by = Auth::user()->id;
        $announcement->save();

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/announcements')->with('success', "Announcement successfully created");
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/announcements')->with('success', "Announcement successfully created");
            }
        }
    }

    public function EditAnnouncement($id)
    {
        $data['getRecord'] = AnnouncementModel::getSingle($id);
        $data['header_title'] = 'Edit Announcement';

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.announcements.create_announcement.edit', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.announcements.create_announcement.edit', $data);
            }
        }
    }

    public function UpdateAnnouncement($id, Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'notice_date' => 'required|date|after_or_equal:today',
            'description' => 'required|string',
        ]);

        $announcement = AnnouncementModel::getSingle($id);
        $announcement->title = $request->title;
        $announcement->notice_date = $request->notice_date;
        $announcement->description = $request->description;
        $announcement->save();

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/announcements')->with('success', "Announcement successfully updated");
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/announcements')->with('success', "Announcement successfully updated");
            }
        }
    }

    public function deleteAnnouncement($id)
    {
        $announcement = AnnouncementModel::getSingle($id);
        if (!$announcement) {
            return redirect()->back()->with('error', "Announcement not found");
        }
        $announcement->delete();

        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/announcements')->with('success', "Announcement successfully deleted.");
            } elseif (Auth::user()->user_type == 'user') {
                return redirect('user/announcements')->with('success', "Announcement successfully deleted.");
            }
        }
        return redirect('login')->with('error', 'Please log in to access this page.');
    }

    public function CheckAnnouncement()
    {
        $today = Carbon::now()->toDateString();
        $futureDate = Carbon::now()->addDays(30)->toDateString();

        // Debugging
        Log::info("Today: $today, Future Date: $futureDate");

        $data['getRecord'] = AnnouncementModel::whereDate('notice_date', '>=', $today)
            ->whereDate('notice_date', '<=', $futureDate)
            ->orderBy('notice_date', 'desc')
            ->get();

        return view('user.announcements.create_announcement.list', $data);
    }
}

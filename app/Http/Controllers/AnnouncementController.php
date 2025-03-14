<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnnouncementModel;
use App\Models\User;
use App\Models\MembersModel;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendAnnouncementMail;
use Illuminate\Support\Facades\Mail;

class AnnouncementController extends Controller
{

    public function SendAnnouncement()
    {
        $data['members'] = MembersModel::where('is_delete', 0)->get();
        $data['header_title'] = 'Send Announcement';
        return view('admin.announcements.send_announcement', $data);
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

        return redirect()->back()->with('success', "Announcement Email successfully sent");
    }
    public function Announcement()
    {
        $data['getRecord'] = AnnouncementModel::getRecord();
        $data['header_title'] = 'Create Announcement';
        return view('admin.announcements.create_announcement.list', $data);
    }

    public function AddAnnouncement()
    {
        $data['header_title'] = 'Add Announcement';
        return view('admin.announcements.create_announcement.add', $data);
    }

    public function InsertAnnouncement(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'notice_date' => 'required|date|after_or_equal:today',
            'publish_date' => 'required|date|after_or_equal:today|different:notice_date',
            'description' => 'required|string',
        ]);

        $announcement = new AnnouncementModel();
        $announcement->title = $request->title;
        $announcement->notice_date = $request->notice_date;
        $announcement->publish_date = $request->publish_date;
        $announcement->description = $request->description;
        $announcement->created_by = Auth::user()->id;
        $announcement->save();

        return redirect('admin/announcements')->with('success', "Announcement successfully created");
    }

    public function EditAnnouncement($id)
    {
        $data['getRecord'] = AnnouncementModel::getSingle($id);
        $data['header_title'] = 'Edit Announcement';
        return view('admin.announcements.create_announcement.edit', $data);
    }

    public function UpdateAnnouncement($id, Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'notice_date' => 'required|date|after_or_equal:today',
            'publish_date' => 'required|date|after_or_equal:today|different:notice_date',
            'description' => 'required|string',
        ]);

        $announcement = AnnouncementModel::getSingle($id);
        $announcement->title = $request->title;
        $announcement->notice_date = $request->notice_date;
        $announcement->publish_date = $request->publish_date;
        $announcement->description = $request->description;
        $announcement->save();

        return redirect('admin/announcements')->with('success', "Announcement successfully updated");
    }

    public function DeleteAnnouncement($id)
    {
        $announcement = AnnouncementModel::getSingle($id);
        if (!$announcement) {
            return redirect('admin/announcements')->with('error', "Announcement not found");
        }
        $announcement->delete();

        return redirect('admin/announcements')->with('success', "Announcement successfully deleted.");
    }
}

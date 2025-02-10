<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnnouncementModel;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{

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

        return redirect('admin/announcements')->with('success', "Announcement successfully deleted");
    }
}

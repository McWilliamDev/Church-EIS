<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnnouncementModel;
use App\Models\User;
use App\Models\MembersModel;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{

    public function SendAnnouncement()
    {
        $data['header_title'] = 'Send Announcement';
        return view('admin.announcements.send_announcement', $data);
    }
    public function SearchUser(Request $request)
    {
        $json = array();
        if (!empty($request->search)) {
            $getUser = User::SearchUser($request->search);
            foreach ($getUser as $value) {
                $type = '';
                if ($value->user_type == 'admin') {
                    $type = 'Church Administrator';
                } elseif ($value->user_type == 'user') {
                    $type = 'Administrator';
                } elseif ($value->user_type == 'members') {
                    $type = 'Members';
                }
                $name = $value->name . ' ' . $value->email . ' - ' . $type;
                $json[] = ['id' => $value->id, 'text' => $name];
            }
        }

        echo json_encode($json);
    }

    public function SendAnnouncementUser(Request $request)
    {
        dd($request->all());
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AnnouncementModel extends Model
{
    use HasFactory;

    protected $table = 'announcements';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecord()
    {
        $return = self::select('announcements.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'announcements.created_by');

        if (!empty(Request::get('title'))) {
            $return = $return->where('announcements.title', 'LIKE', '%' . trim(Request::get('title')) . '%');
        }

        if (!empty(Request::get('notice_date_from'))) {
            $return = $return->where('announcements.notice_date', '>=', Request::get('notice_date_from'));
        }

        if (!empty(Request::get('notice_date_to'))) {
            $return = $return->where('announcements.notice_date', '<=', Request::get('notice_date_to'));
        }

        if (!empty(Request::get('publish_date_from'))) {
            $return = $return->where('announcements.publish_date', '>=', Request::get('publish_date_from'));
        }

        if (!empty(Request::get('publish_date_to'))) {
            $return = $return->where('announcements.publish_date', '<=', Request::get('publish_date_to'));
        }

        $return = $return->orderBy('announcements.id', 'desc')
            ->paginate(999999);

        return $return;
    }
}

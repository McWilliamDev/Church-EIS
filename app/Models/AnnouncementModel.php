<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;

class AnnouncementModel extends Model
{
    use HasFactory;

    protected $table = 'announcements';
    protected $casts = [
        'notice_date' => 'datetime',
        'publish_date' => 'datetime',
    ];

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
    public static function getUpcomingAnnouncements()
    {
        $today = Carbon::now();
        $nextWeek = $today->copy()->addDays(7);

        return self::where('notice_date', '>=', $today)
            ->where('notice_date', '<=', $nextWeek)
            ->orderBy('notice_date', 'asc')
            ->get();
    }
}

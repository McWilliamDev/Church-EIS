<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventsModel extends Model
{
    protected $table = 'events';
    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function getRecord()
    {
        $return = EventsModel::select('events.*', 'users.name as created_by')
            ->join('users', 'users.id', 'events.created_by')
            ->orderBy('events.id', 'desc')
            ->paginate(999999);

        return $return;
    }

    public function getFeatured()
    {
        if (!empty($this->featured_image) && file_exists('upload/featured/' . $this->featured_image)) {
            return url('upload/featured/' . $this->featured_image);
        } else {
            return "";
        }
    }
    public static function getUpcomingEvents()
    {
        $today = now();
        $nextWeek = now()->addDays(30);

        return self::whereBetween('date', [$today, $nextWeek])
            ->select('events.*', 'users.name as created_by')
            ->join('users', 'users.id', 'events.created_by')
            ->orderBy('events.date', 'desc')
            ->get();
    }
}

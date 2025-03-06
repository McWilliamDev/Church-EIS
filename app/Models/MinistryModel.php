<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinistryModel extends Model
{
    use HasFactory;
    protected $table = 'ministry';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecord()
    {
        $return = MinistryModel::select('ministry.*', 'users.name as created_by')
            ->join('users', 'users.id', 'ministry.created_by')
            ->where('ministry.is_delete', '=', 0)
            ->orderBy('ministry.id', 'asc')
            ->paginate();

        return $return;
    }

    public function getMinistryProfile()
    {
        if (!empty($this->ministry_profile) && file_exists('upload/ministry/' . $this->ministry_profile)) {
            return url('upload/ministry/' . $this->ministry_profile);
        } else {
            return "";
        }
    }

    //Joined to Assigned Ministry
    public static function getMinistries()
    {
        $return = MinistryModel::select('ministry.*')
            ->where('ministry.is_delete', '=', 0)
            ->where('ministry.ministry_status', '=', 0)
            ->orderBy('ministry.ministry_name', 'asc')
            ->get();

        return $return;
    }
}

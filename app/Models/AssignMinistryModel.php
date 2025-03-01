<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AssignMinistryModel extends Model
{
    use HasFactory;
    protected $table = 'assign_ministry';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecord()
    {
        $return = self::select('assign_ministry.*', 'members.name as member_name', 'members.last_name as member_lname', 'ministry.ministry_name as ministry_name')
            ->join('members', 'members.id', '=', 'assign_ministry.member_id')
            ->join('ministry', 'ministry.id', '=', 'assign_ministry.ministry_id');

        if (!empty(Request::get('member_name'))) {
            $return = $return->where('members.name', 'like', '%' . Request::get('member_name') . '%');
        }

        if (!empty(Request::get('ministry_name'))) {
            $return = $return->where('ministry.ministry_name', 'like', '%' . Request::get('ministry_name') . '%');
        }

        if (!empty(Request::get('ministry_status'))) {
            $ministry_status = (Request::get('ministry_status') == 100) ? 0 : 1;
            $return = $return->where('assign_ministry.ministry_status', '=', $ministry_status);
        }

        $return = $return->orderBy('assign_ministry.id', 'desc')->paginate(10);

        return $return;
    }
}

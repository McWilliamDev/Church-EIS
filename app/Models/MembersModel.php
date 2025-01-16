<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembersModel extends Model
{
    use HasFactory;
    protected $table = 'members';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    //public static function getMember()
    //{
    //    $return = self::select('members.*', 'ministry.ministry_name as ministry_name')
    //        ->join('ministry', 'ministry.id', '=', 'members.ministry_id', 'left')
    //        ->where('is_delete', '=', 0);
    //    $return = $return->orderBy('members.id', 'desc')
    //        ->paginate(10);

    //    return $return;
    //}
    public static function getMember()
    {
        $return = self::select('members.*', 'ministry.ministry_name as ministry_name')
            ->leftJoin('ministry', 'ministry.id', '=', 'members.ministry_id')
            ->where('members.is_delete', '=', 0)
            ->orderBy('members.id', 'desc')
            ->paginate(10);

        return $return;
    }
    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists('upload/profile/' . $this->profile_pic)) {
            return url('upload/profile/' . $this->profile_pic);
        } else {
            return "";
        }
    }
}

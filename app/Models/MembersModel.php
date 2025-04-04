<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class MembersModel extends Model
{
    use HasFactory;
    //protected $fillable = ['id', 'name', 'last_name', 'email', 'phonenumber', 'gender', 'ministry_id', 'date_of_birth', 'profile_pic', 'address', 'member_status', 'created_by', 'created_at', 'updated_at', 'is_delete', 'locked_by', 'locked_at'];
    protected $table = 'members';

    protected $fillable = [
        'locked_by',
        'locked_at'
    ];
    public static function getSingle($id)
    {
        return self::find($id);
    }

    //For Dashboard Date Count
    public static function getTotalMembers()
    {
        return self::where('is_delete', '=', 0)->count();
    }

    //For Pie Chart Data
    public static function getMemberStatusCounts()
    {
        $activeCount = self::where('member_status', 0)->where('is_delete', 0)->count();
        $inactiveCount = self::where('member_status', 1)->where('is_delete', 0)->count();

        return [
            'active' => $activeCount,
            'inactive' => $inactiveCount,
        ];
    }

    public static function getMember()
    {
        $return = self::select('members.*', 'users.name as created_by', 'ministry.ministry_name as ministry_name')
            ->join('users', 'users.id', 'members.created_by')
            ->leftJoin('ministry', 'ministry.id', '=', 'members.ministry_id')
            ->where('members.is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('members.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('members.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('phonenumber'))) {
            $return = $return->where('members.phonenumber', 'like', '%' . Request::get('phonenumber') . '%');
        }
        if (!empty(Request::get('member_status'))) {
            $member_status = (Request::get('member_status') == 100) ? 0 : 1;
            $return = $return->where('members.member_status', '=', $member_status);
        }

        $return = $return->orderBy('members.id', 'desc')
            ->paginate(999999);

        return $return;
    }
    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists('upload/member_profiles/' . $this->profile_pic)) {
            return url('upload/member_profiles/' . $this->profile_pic);
        } else {
            return "";
        }
    }

    public function reports()
    {
        return $this->hasMany(FinanceModel::class, 'member_id', 'id');
    }
    //Joined to Assigned Ministry
    public static function getMembers()
    {
        $return = MembersModel::select('members.*')
            ->leftJoin('assign_ministry', 'members.id', '=', 'assign_ministry.member_id')
            ->where('members.is_delete', '=', 0)
            ->whereNull('assign_ministry.member_id')
            ->get();
        return $return;
    }
    public static function getMembersEdit()
    {
        $return = MembersModel::select('members.*')
            ->leftJoin('assign_ministry', 'members.id', '=', 'assign_ministry.member_id')
            ->where('members.is_delete', '=', 0)
            ->get();
        return $return;
    }
    public static function getInactiveMembers()
    {
        return self::where('member_status', 1) //  1 means inactive
            ->where('updated_at', '<=', now()->subMonths(3))
            ->get();
    }
}

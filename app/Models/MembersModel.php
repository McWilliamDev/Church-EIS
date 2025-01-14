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

    public static function getMember()
    {
        return self::select('members.*')
            ->where('is_delete', '=', 0)
            ->orderBy('members.id', 'asc')
            ->paginate(10);
    }
}

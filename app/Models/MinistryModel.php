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
            ->paginate(10);

        return $return;
    }
}

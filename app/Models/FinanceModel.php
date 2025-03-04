<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceModel extends Model
{
    use HasFactory;

    protected $table = 'finance';
    // `member_id`, `type`, `amount`, `purpose`, `updated_at`, `created_at`
    protected $fillable = ['member_id', 'type', 'amount', 'purpose']; // Allow mass assignment
    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo(MembersModel::class, 'member_id', 'id');
    }
}

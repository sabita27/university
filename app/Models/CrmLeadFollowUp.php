<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class CrmLeadFollowUp extends Model
{
    protected $fillable = [
        'lead_id',
        'follow_up_date',
        'follow_up_time',
        'follow_up_note',
        'created_by',
    ];

    public function lead()
    {
        return $this->belongsTo(CrmLead::class, 'lead_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

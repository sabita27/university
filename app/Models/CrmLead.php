<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class CrmLead extends Model
{
    protected $fillable = [
        'name',
        'father_name',
        'email',
        'phone',
        'educational_qualification',
        'board',
        'total_mark',
        'total_percentage',
        'program_id',
        'lead_source_id',
        'lead_status_id',
        'description',
        'created_by',
        'counsellor_id',
        'status',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function source()
    {
        return $this->belongsTo(CrmLeadSource::class, 'lead_source_id');
    }

    public function leadStatus()
    {
        return $this->belongsTo(CrmLeadStatus::class, 'lead_status_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'counsellor_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function followUps()
    {
        return $this->hasMany(CrmLeadFollowUp::class, 'lead_id')->orderBy('id', 'desc');
    }
}

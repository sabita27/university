<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmLeadStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'color', 'description', 'status',
    ];
}

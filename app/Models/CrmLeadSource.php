<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmLeadSource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'description', 'status',
    ];
}

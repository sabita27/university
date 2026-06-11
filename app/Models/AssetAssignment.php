<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetAssignment extends Model
{
    protected $fillable = [
        'asset_id', 'user_id', 'assigned_date', 'return_date',
        'is_damaged', 'is_returned', 'note',
    ];

    protected $casts = [
        'assigned_date' => 'date',
        'return_date'   => 'date',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'procurement_number',
        'name',
        'purpose',
        'assets',
        'request_date',
        'status',
        'urgency',        // new urgency field
        'urgency_reason', // reason if urgency is Other
        'staff_id',      // foreign key to staff
        'product_id',    // foreign key to product (item)
        'auth_id',       // user who created the request
    ];

    protected $casts = [
        'request_date' => 'date',
        'assets' => 'array',
        // 'urgency' is a string, no cast needed
        // 'urgency_reason' is a string, no cast needed
        'staff_id' => 'integer',
        'product_id' => 'integer',
    ];

    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 0;

    public function product()
    {
        return $this->belongsTo(Item::class, 'product_id');
    }

    public function staff()
    {
        return $this->belongsTo(\App\User::class, 'staff_id');
    }
}

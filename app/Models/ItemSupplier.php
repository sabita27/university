<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ItemSupplier extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'email', 'phone', 'address', 'contact_person', 'designation', 'contact_person_email', 'contact_person_phone', 'description', 'status', 'categories', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'categories' => 'array',
    ];

    public function stocks()
    {
        return $this->hasMany(ItemStock::class, 'supplier_id', 'id');
    }
}

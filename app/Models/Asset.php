<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'name', 'asset_type_id', 'asset_brand_id', 'serial_number',
        'purchased_date', 'purchased_cost', 'description',
        'working_status', 'availability_status',
    ];

    protected $casts = [
        'purchased_date' => 'date',
    ];

    public function assetType()
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id');
    }

    public function assetBrand()
    {
        return $this->belongsTo(AssetBrand::class, 'asset_brand_id');
    }

    public function assignments()
    {
        return $this->hasMany(AssetAssignment::class, 'asset_id');
    }
}

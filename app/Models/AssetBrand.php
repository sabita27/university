<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetBrand extends Model
{
    protected $fillable = ['title', 'status'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'asset_brand_id');
    }
}

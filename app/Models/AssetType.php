<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    protected $fillable = ['title', 'status'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'asset_type_id');
    }
}

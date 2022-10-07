<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'asset';

    public function accessibleUsers()
    {
        return $this->belongsToMany(User::class, 'fund_portfolio_accessible', 'asset_id', 'user_id');
    }

    public function assetFieldGroups()
    {
        return $this->hasMany(AssetFieldGroup::class);
    }
}

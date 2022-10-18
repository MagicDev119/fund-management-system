<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'asset';

    protected $fillable = [
        'name',
        'slug',
        'isLocked',
        'user_id',
        'legal_name'
    ];

    public function accessibleUsers()
    {
        return $this->belongsToMany(User::class, 'fund_portfolio_accessible', 'asset_id', 'user_id');
    }

    public function assetFieldGroups()
    {
        return $this->hasMany(AssetFieldGroup::class);
    }

    public function funds() {
        return $this->belongsToMany(Fund::class, 'fund_portfolio_relation', 'asset_id', 'fund_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

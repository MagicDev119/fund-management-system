<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetFieldGroup extends Model
{
    use HasFactory;
    protected $table = 'asset_field_group';
    
    protected $fillable = [
        'group_name',
        'type',
        'isVisible',
        'slug',
        'asset_id',
        'user_id'
    ];
    /**
     * Get the user that owns the assetFieldGroup.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function assetFields()
    {
        return $this->hasMany(AssetField::class, 'group_id');
    }

    public static function getDefaults()
    {
        $defaultAssetFieldGroups = AssetFieldGroup::where('type', 1)->get();
        return $defaultAssetFieldGroups;
    }
}

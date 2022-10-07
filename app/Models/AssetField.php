<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetField extends Model
{
    use HasFactory;
    protected $table = 'asset_field';

    public function fieldType()
    {
        return $this->belongsTo(FieldType::class);
    }

    public function assetFieldGroup()
    {
        return $this->belongsTo(AssetFieldGroup::class, 'group_id');
    }
}

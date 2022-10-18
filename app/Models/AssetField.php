<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetField extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'asset_field';

    protected $fillable = [
        'group_id',
        'name',
        'slug',
        'field_type_id',
        'isVisible',
        'isEditable',
        'isTimestampField',
        'isRequired'
    ];

    public function fieldType()
    {
        return $this->belongsTo(FieldType::class);
    }

    public function assetFieldGroup()
    {
        return $this->belongsTo(AssetFieldGroup::class, 'group_id');
    }

    public function assetData() {
        return $this->hasOne(AssetData::class);
    }
}

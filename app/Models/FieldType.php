<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldType extends Model
{
    use HasFactory;
    protected $table = 'field_type';

    public function fundFields() {
        return $this->hasMany(FundField::class, 'field_type_id');
    }

    public function assetFields() {
        return $this->hasMany(AssetField::class, 'field_type_id');
    }
}

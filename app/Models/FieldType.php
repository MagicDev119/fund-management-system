<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'field_type';

    protected $fillable = [
        'name',
        'slug',
        'cate_name',
        'cate_name',
        'table'
    ];

    public function fundFields() {
        return $this->hasMany(FundField::class, 'field_type_id');
    }

    public function assetFields() {
        return $this->hasMany(AssetField::class, 'field_type_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFieldCategories extends Model
{
    use HasFactory;
    protected $table = 'data_field_categories';

    protected $fillable = [
        'asset_id',
        'category_name',
        'type',
        'isLocked'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function companyMatrics()
    {
        return $this->hasMany(CompanyMatrics::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(AnalysisComment::class, 'data_field_category_id');
    }
}

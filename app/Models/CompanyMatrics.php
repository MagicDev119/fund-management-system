<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyMatrics extends Model
{
    use HasFactory;
    protected $table = 'company_matrics';

    protected $fillable = [
        'category_id',
        'matrics_resource_id'
    ];

    public function dataFieldCategory()
    {
        return $this->belongsTo(DataFieldCategories::class, 'category_id');
    }

    public function matricsResource()
    {
        return $this->belongsTo(MatricsResource::class);
    }

    public function datas()
    {
        return $this->hasMany(CustomReportMatricsData::class);
    }
}

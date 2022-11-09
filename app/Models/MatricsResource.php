<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatricsResource extends Model
{
    use HasFactory;
    protected $table = 'matrics_resource';

    protected $fillable = [
        'user_id',
        'name',
        'matrics_category_id',
        'matrics_unit_id',
        'decimals'
    ];

    public function companyMatrics()
    {
        return $this->hasMany(CompanyMatrics::class);
    }

    public function MatricsUnit()
    {
        return $this->belongsTo(MatricsUnit::class);
    }
}

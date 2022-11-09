<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomReportMatricsData extends Model
{
    use HasFactory;
    protected $table = 'custom_report_matrics_data';

    protected $fillable = [
        'company_matrics_id',
        'value',
        'set_date'
    ];

    public function CompanyMatrics()
    {
        return $this->belongsTo(CompanyMatrics::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundData extends Model
{
    use HasFactory;

    protected $table = 'fund_data';
    
    protected $fillable = [
        'fund_field_id',
        'value'
    ];

    public function fundField() {
        return $this->belongsTo(FundField::class);
    }
}

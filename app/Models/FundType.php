<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundType extends Model
{
    use HasFactory;
    protected $table = 'fund_type';
    
    public function funds() {
        return $this->hasMany(Fund::class);
    }
}

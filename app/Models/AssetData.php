<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetData extends Model
{
    use HasFactory;
    protected $fillable = [
        'fund_field_id',
        'value',
        'set_date'
    ];
}

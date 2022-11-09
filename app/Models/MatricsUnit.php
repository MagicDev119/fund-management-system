<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatricsUnit extends Model
{
    use HasFactory;
    protected $table = 'matrics_unit';

    public function MatricsResource()
    {
        return $this->hasMany(MatricsResource::class);
    }
}

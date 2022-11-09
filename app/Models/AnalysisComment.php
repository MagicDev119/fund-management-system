<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisComment extends Model
{
    use HasFactory;
    protected $table = 'analysis_comment';

    protected $fillable = [
        'user_id',
        'data_field_category_id',
        'period',
        'content'
    ];

    public function dataFieldCategory()
    {
        return $this->belongsTo(DataFieldCategories::class, 'data_field_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

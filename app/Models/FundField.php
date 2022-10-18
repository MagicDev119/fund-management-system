<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundField extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'fund_field';
    
    protected $fillable = [
        'group_id',
        'name',
        'slug',
        'field_type_id',
        'isVisible',
        'isRequired'
    ];
    /**
     * Get the fundFieldGroup that owns the fundField.
     */
    public function fundFieldGroup()
    {
        return $this->belongsTo(FundFieldGroup::class, 'group_id');
    }

    public function fieldType()
    {
        return $this->belongsTo(FieldType::class);
    }

    public function fundData() {
        return $this->hasOne(FundData::class);
    }
}

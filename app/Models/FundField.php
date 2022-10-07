<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundField extends Model
{
    use HasFactory;
    protected $table = 'fund_field';
    
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

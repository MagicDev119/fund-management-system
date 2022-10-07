<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundFieldGroup extends Model
{
    use HasFactory;
    protected $table = 'fund_field_group';

    /**
     * Get the user that owns the fundFieldGroup.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the fundFields for the fundFieldGroup.
     */
    public function fundFields()
    {
        return $this->hasMany(FundField::class, 'group_id');
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundFieldGroup extends Model
{
    use HasFactory;
    protected $table = 'fund_field_group';

    protected $fillable = [
        'group_name',
        'type',
        'isVisible',
        'slug',
        'fund_id',
        'user_id'
    ];
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

    public static function getDefaults()
    {
        $defaultFundFieldGroups = FundFieldGroup::where('type', 1)->get();
        return $defaultFundFieldGroups;
    }
}

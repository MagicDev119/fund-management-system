<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;
    protected $table = 'fund';

    protected $fillable = [
        'name',
        'slug',
        'fund_type_id',
        'currency',
        'legal_name'
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_fund_relation', 'fund_id', 'user_id');
    }

    public function accessibleUsers()
    {
        return $this->belongsToMany(User::class, 'fund_portfolio_accessible', 'fund_id', 'user_id');
    }

    public function fundFieldGroups()
    {
        return $this->hasMany(FundFieldGroup::class)
                    ->where(function ($query) {
                        $query->where('fund_field_group.isVisible', true);
                    });
    }

    public function fundType()
    {
        return $this->belongsTo(FundType::class);
    }

    public function assets() {
        return $this->belongsToMany(Asset::class, 'fund_portfolio_relation', 'fund_id', 'asset_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;
    protected $table = 'fund';
    
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
        return $this->hasMany(FundFieldGroup::class);
    }

    public function fundType()
    {
        return $this->belongsTo(FundType::class);
    }
}

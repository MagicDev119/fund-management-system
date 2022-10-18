<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'admin_role',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the fundFieldGroup associated with the user.
     */
    public function fundFieldGroups()
    {
        return $this->hasMany(FundFieldGroup::class);
    }

    /**
     * Get the assetFieldGroup associated with the user.
     */
    public function assetFieldGroups()
    {
        return $this->hasMany(AssetFieldGroup::class);
    }

    public function adminRole()
    {
        return $this->belongsTo(AdminRole::class);
    }

    public function userRoles() {
        return $this->belongsToMany(UserRole::class, 'user_role_relation', 'user_id', 'role_id');
    }

    public function accessibleTabs() {
        return $this->belongsToMany(AccessibleTab::class, 'user_accessible_tab_relation', 'user_id', 'accessible_tab_id');
    }

    public function accessibleFunds() {
    	return $this->belongsToMany(Fund::class, 'fund_portfolio_accessible', 'user_id', 'fund_id');
    }

    public function accessibleAssets() {
    	return $this->belongsToMany(Asset::class, 'fund_portfolio_accessible', 'user_id', 'asset_id');
    }

    public function funds() {
        return $this->belongsToMany(Fund::class, 'user_fund_relation', 'user_id', 'fund_id');
    }

    public function assets() {
        return $this->hasMany(Asset::class);
    }
}

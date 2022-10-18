<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'user_role';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role_relation', 'role_id', 'user_id');
    }

    public static function getDefaults()
    {
        $defaultRoles = UserRole::where('isDefault', true)->get();
        return $defaultRoles;
    }
}

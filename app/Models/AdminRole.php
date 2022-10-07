<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;
    protected $table = 'admin_role';

    public const MASTER = 1;
    public const ADMIN = 2;
    public const GENERAL = 3;

    public function users() {
        return $this->hasMany(User::class, 'admin_role');
    }
}

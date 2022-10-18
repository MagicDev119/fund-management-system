<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessibleTab extends Model
{
    use HasFactory;
    protected $table = 'accessible_tab';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_accessible_tab_relation', 'accessible_tab_id', 'user_id');
    }

    public static function getDefaults()
    {
        $defaultTabs = AccessibleTab::where('isDefault', true)->get();
        return $defaultTabs;
    }
}

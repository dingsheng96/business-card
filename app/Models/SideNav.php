<?php

namespace App\Models;

use App\Traits\Models\HasSort;
use App\Models\PermissionGroup;
use App\Models\SideNavPermissionGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SideNav extends Model
{
    use HasFactory,
        HasSort;

    protected $table = 'side_navs';

    protected $appends = [
        'is_parent'
    ];

    // relations
    public function permissionGroups()
    {
        return $this->belongsToMany(PermissionGroup::class, SideNavPermissionGroup::class);
    }

    public function parentNavItem()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function childNavItems()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    // accessors
    public function getIsParentAttribute()
    {
        return is_null($this->parent_id) || empty($this->parent_id);
    }
}

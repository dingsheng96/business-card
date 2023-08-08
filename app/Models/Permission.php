<?php

namespace App\Models;

use App\Models\PermissionGroup;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    // relations
    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class, 'permission_group_id', 'id');
    }
}

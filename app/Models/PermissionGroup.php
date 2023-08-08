<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionGroup extends Model
{
    use HasFactory;

    protected $table = "permission_groups";

    // relations
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_group_id', 'id');
    }
}

<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    const ROLE_SUPER_ADMIN = 'superadmin';
}

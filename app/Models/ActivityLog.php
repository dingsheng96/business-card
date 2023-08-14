<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Activity as SpatieActivityLog;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;

class ActivityLog extends SpatieActivityLog implements ActivityContract
{
    const ENV_PRODUCTION = 1;
    const ENV_LOCALHOST = 2;
    const ENV_STAGING = 3;

    public $hiddenInputs = [
        '_token',
        '_method',
        'password',
        'password_confirmation'
    ];

    public function getHiddenInputs()
    {
        return $this->hiddenInputs;
    }
}

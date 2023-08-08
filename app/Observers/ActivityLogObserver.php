<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Stevebauman\Location\Facades\Location;

class ActivityLogObserver
{
    /**
     * Handle the ActivityLog "created" event.
     */
    public function created(ActivityLog $activityLog): void
    {
        //
    }

    /**
     * Handle the ActivityLog "creating" event.
     */
    public function creating(ActivityLog $activityLog): void
    {
        $activityLog->host = request()->getHost();
        $activityLog->path = request()->getPathInfo();
        $activityLog->ip_address = request()->ip();
        $activityLog->user_agent = request()->userAgent();

        if (app()->isLocal()) {
            $activityLog->environment = ActivityLog::ENV_LOCALHOST;
        } else {
            $activityLog->environment = app()->isProduction() ? ActivityLog::ENV_PRODUCTION : ActivityLog::ENV_STAGING;

            if ($location = Location::get(request()->ip())) {
                $activityLog->trackers = $location;
                $activityLog->location = implode(",", [$location->regionName, $location->countryName]);
            }
        }
    }

    /**
     * Handle the ActivityLog "updated" event.
     */
    public function updated(ActivityLog $activityLog): void
    {
        //
    }

    /**
     * Handle the ActivityLog "deleted" event.
     */
    public function deleted(ActivityLog $activityLog): void
    {
        //
    }

    /**
     * Handle the ActivityLog "restored" event.
     */
    public function restored(ActivityLog $activityLog): void
    {
        //
    }

    /**
     * Handle the ActivityLog "force deleted" event.
     */
    public function forceDeleted(ActivityLog $activityLog): void
    {
        //
    }
}

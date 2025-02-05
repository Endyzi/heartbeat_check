<?php

namespace App\Http\Graphql\Queries;
use App\Models\Heartbeat;
use Carbon\Carbon;

class HeartbeatQuery
{

/**
 * Heartbeat query for unhealthy heartbeats, with filter
 */
    public function resolve($root, array $args)
    {
        $query = Heartbeat::query();

        if (!empty($args['applicationKeys'])) {
            $query->whereIn('application_key', $args['applicationKeys']);
        }

        return $query->get()->filter(function ($heartbeat) {
            return $heartbeat->last_check_in <= now()->subMinutes($heartbeat->unhealthy_after_minutes);
        });

    }

}
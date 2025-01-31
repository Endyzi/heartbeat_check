<?php

namespace App\GraphQL\Mutations;

use App\Models\Heartbeat;
use Carbon\Carbon;

class SendHeartbeatMutation
{
    /**
     * Create or update heartbeat
     */
    public function __invoke($_,array $args)
    {
        $input = $args['input'];

        $heartbeat = Heartbeat::updateOrCreate(
            [
                'application_key' => $input['applicationKey'],
                'heartbeat_key' => $input['heartbeatKey'],
            ],
            [
                'unhealthy_after_minutes' => $input['unhealthyAfterMinutes'],
                'last_check_in' => Carbon::now(),
            ]
            );

            return [
                'heartbeat' => $heartbeat,
           ];
  }

} 
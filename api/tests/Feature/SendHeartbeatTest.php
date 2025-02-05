<?php

namespace Tests\Feature;

use App\Models\Heartbeat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SendHeartbeatTest extends TestCase
{
    /**
     * Test for the sendheartbeatmutation
     */
    public function test_send_heartbeat_creates_or_updates_record()
    {
        $response = $this->graphql('
        mutation{
        sendHeartbeat(input: {
         applicationKey: "app-1",
         heartbeatKey: "sync-job",
         unhealthyAfterMinutes: 5
        }) {
         hearbeat {
          applicationKey
          heartbeatKey
          unhealthyAfterMinutes
          lastCheckIn
        }
       }
      }
    ');

        $response->assertJson([
            'data' => [
                'sendheartbeat' => [
                    'heartbeat' => [
                        'applicationKey' => 'app-1',
                        'heartbeatKey' => 'sync-job',
                        'unhealthyAfterMinutes' => 5,
                    ],
                ],
            ],
        ]);

        $this->assertDatabaseHas('heartbeats', [
            'application_Key' => 'app-1',
            'heartbeat_key' => 'sync-job',
        ]);
    }
}

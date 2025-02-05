<?php

namespace Tests\Feature\Queries;

use App\Models\Heartbeat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnhealthyHeartbeatsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_only_unhealthy_heartbeats(): void
    {
        // create unhealthy and healthy hbs
        Heartbeat::factory()->create([
            'application_key' => 'app-1',
            'heartbeat_key' => 'sync-job',
            'unhealthy_after_minutes' => 5,
            'last_check_in' => now()->subMinutes(10),  // this should be interpreted as an "unhealthy" hb
        ]);

        Heartbeat::factory()->create([
            'application_key' => 'app-2',
            'heartbeat_key' => 'sync-job',
            'unhealthy_after_minutes' => 5,
            'last_check_in' => now(),  // this should be interpreted as a "healthy" hb
        ]);

        
        $response = $this->graphQL('
        {
          unhealthyHeartbeats(applicationKeys: ["app-1"]) {
            applicationKey
            heartbeatKey
            lastCheckIn
          }
        }
        ');

       
        $response->assertJson([
            'data' => [
                'unhealthyHeartbeats' => [
                    [
                        'applicationKey' => 'app-1',
                        'heartbeatKey' => 'sync-job',
                    ],
                ],
            ],
        ]);
    }
}

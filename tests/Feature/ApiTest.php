<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\EventScheduler\Entities\Event;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->initDatabase();
    }
    
    /**
     * Get event by date
     *
     * @return void
     */
    public function test_get_event_by_date()
    {
        $response = $this->get('/api/event?' . Carbon::now()->format('d-m-Y'));

        $response->assertStatus(200);
    }

     /**
     * Create event
     *
     * @return void
     */
    public function test_create_event()
    {
        $data = Event::factory()->make()->toArray();

        $response = $this->post('/api/event', $data);

        $response->assertStatus(201);
    }

    /**
     * Update event
     *
     * @return void
     */
    public function test_update_event()
    {
        $data = Event::factory()->make()->toArray();

        $this->post('/api/event', $data);
        
        $event = Event::inRandomOrder()->first();

        $response = $this->put('/api/event/'.$event->id , $event->toArray());

        $response->assertStatus(200);
    }

    /**
     * Delete event
     *
     * @return void
     */
    public function test_delete_event()
    {
        $data = Event::factory()->make()->toArray();
        
        $this->post('/api/event', $data);
        
        $event = Event::inRandomOrder()->first();

        $response = $this->delete('/api/event/'.$event->id);

        $response->assertStatus(200);
    }

    /**
     * Send Notification command
     *
     * @return void
     */
    public function test_send_notification_command()
    {
        $this->artisan('events:send')->assertExitCode(0);
    }
}

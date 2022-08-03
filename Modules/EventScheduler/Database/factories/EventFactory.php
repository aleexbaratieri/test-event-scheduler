<?php

namespace Modules\EventScheduler\Database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class EventFactory extends Factory
{
    use WithFaker;
    
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\EventScheduler\Entities\Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            "event_time" => $this->faker->date('m/d/Y H:i', Carbon::now()->addYear()),
            "email_to_notification" => $this->faker->email
        ];
    }
}


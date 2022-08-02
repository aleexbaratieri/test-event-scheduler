<?php

namespace Modules\EventScheduler\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "event_time" => $this->event_time,
            "email_to_notification" => $this->email_to_notification,
        ];
    }
}

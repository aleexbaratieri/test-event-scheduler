<?php

namespace Modules\EventScheduler\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\EventScheduler\Repositories\EventRepository;

class EventService extends Service
{
    /**
     * Repository Instance.
     *
     * @var array
     */
    protected $repository;
    
    /**
     * Filters accepteds.
     *
     * @var array
     */
    protected $filters = [
        'day'
    ];

    public function __construct(EventRepository $eventRepository)
    {
        $this->repository = $eventRepository;
    }

    public function nextEvents($minutes = 10) : ?\Illuminate\Database\Eloquent\Collection
    {
        return $this->repository->nextEvents($minutes);
    }
}
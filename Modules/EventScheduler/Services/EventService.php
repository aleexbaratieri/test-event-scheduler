<?php

namespace Modules\EventScheduler\Services;

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
}
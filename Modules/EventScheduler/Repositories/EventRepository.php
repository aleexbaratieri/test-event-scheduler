<?php

namespace Modules\EventScheduler\Repositories;

use App\Exceptions\InternalException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\EventScheduler\Entities\Event;

class EventRepository extends Repository
{
    protected $entity;

    public function __construct(Event $event)
    {
        $this->entity = $event;
    }

    public function update(array $data, int $id)
    {
        $resource = $this->find($id);

        if($resource->sent === true) {
            throw new InternalException("O evento não pode ser modificado.", 400);
        }

        try {
            
            $resource->update($data);
            return $resource;
        
        } catch (\Exception $err) {

            Log::error($err->getMessage());
            throw new InternalException();
        }
    }

    protected function applyFilters($filters)
    {
        if(count($filters) > 0) {
            
            collect($filters)->each(function($value, $filter) {
                if($filter === 'day') {
                    $dateStart = Carbon::createFromFormat('d-m-Y', $value)->startOfDay();
                    $dateEnd = Carbon::createFromFormat('d-m-Y', $value)->endOfDay();
                    $this->entity = $this->entity->whereBetween('event_time', [$dateStart, $dateEnd]);
                }
            });
        
        }

        return $this->entity;
    }

    public function nextEvents($minutes = 10) : mixed
    {
        return $this->entity->where('sent', false)->where('event_time', '>=', Carbon::now()->timestamp)->where('event_time', '<=', Carbon::now()->addMinutes($minutes)->timestamp)->get();
    }
}
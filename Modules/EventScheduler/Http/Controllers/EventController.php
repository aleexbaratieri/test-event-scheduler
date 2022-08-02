<?php

namespace Modules\EventScheduler\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\EventScheduler\Http\Requests\StoreUpdateEventRequest;
use Modules\EventScheduler\Services\EventService;
use Modules\EventScheduler\Transformers\EventResource;

class EventController extends Controller
{
    protected $service;

    public function __construct(EventService $eventService)
    {
        $this->service = $eventService;
    }
    
    /**
     * Display a listing of the events.
     * @return EventResource
     */
    public function index(Request $filters)
    {
        $events = $this->service->all($filters->all());
        return EventResource::collection($events);
    }

    /**
     * Store a newly created event in storage.
     * @param StoreUpdateEventRequest $request
     * @return Response
     */
    public function store(StoreUpdateEventRequest $request)
    {
        $this->service->store($request->validated());
        return response()->json(["message" => "O evento foi criado com sucesso."], 201);
    }

    /**
     * Show the specified event.
     * @param int $id
     * @return EventResource
     */
    public function show($id)
    {
        $event = $this->service->find($id);
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     * @param StoreUpdateEventRequest $request
     * @param int $id
     * @return EventResource
     */
    public function update(StoreUpdateEventRequest $request, $id)
    {
        $this->service->update($request->validated(), $id);
        return response()->json(["message" => "O evento foi editado com sucesso."]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(["message" => "O evento foi removido com sucesso."]);
    }
}

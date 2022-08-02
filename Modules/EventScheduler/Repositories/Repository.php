<?php

namespace Modules\EventScheduler\Repositories;

use App\Exceptions\InternalException;
use Illuminate\Support\Facades\Log;
use Modules\EventScheduler\Contracts\Api;

abstract class Repository implements Api
{

    public function all(array $filters)
    {
        try {
            
            $this->entity = $this->applyFilters($filters);
            return $this->entity->get();
        
        } catch (\Exception $err) {

            Log::error($err->getMessage());
            throw new InternalException();
        }
    }

    public function find(int $id)
    {
        return $this->entity->where('id', $id)->firstOrFail();
    }

    public function store(array $data)
    {
        try {

            return $this->entity->create($data);
        
        } catch (\Exception $err) {

            Log::error($err->getMessage());
            throw new InternalException();
        }
        
    }

    public function update(array $data, int $id)
    {
        $resource = $this->find($id);

        try {
            
            $resource->update($data);
            return $resource;
        
        } catch (\Exception $err) {

            Log::error($err->getMessage());
            throw new InternalException();
        }
    }

    public function destroy(int $id)
    {
        try {
            
            $this->entity->where('id', $id)->delete();
        
        } catch (\Exception $err) {

            Log::error($err->getMessage());
            throw new InternalException();
        }
    }
}
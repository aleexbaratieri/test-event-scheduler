<?php

namespace Modules\EventScheduler\Services;

use Modules\EventScheduler\Contracts\Api;

abstract class Service implements Api
{
    public function all(array $filters)
    {
        $filters = (collect($filters)->filter(
            fn ($value, $filter) => in_array($filter, $this->filters)
        ));
        
        return $this->repository->all($filters->toArray());
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update(array $data, int $id)
    {
        return $this->repository->update($data, $id);
    }

    public function destroy(int $id)
    {
        $this->repository->destroy($id);
    }
}
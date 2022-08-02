<?php

namespace Modules\EventScheduler\Contracts;

interface Api
{
    public function all(array $filters);

    public function find(int $id);

    public function store(array $data);

    public function update(array $data, int $id);

    public function destroy(int $id);
}
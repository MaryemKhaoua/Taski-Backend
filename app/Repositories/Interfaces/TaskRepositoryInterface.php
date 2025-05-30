<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function all();
    public function find($id, $authUser);
    public function create(array $data);
    public function update($id, array $data, $authUser);
    public function delete($id);
}
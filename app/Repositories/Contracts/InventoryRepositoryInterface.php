<?php

namespace App\Repositories\Contracts;

interface InventoryRepositoryInterface
{
    public function get();

    public function update($id, $data);

    public function search( array $filters);
}

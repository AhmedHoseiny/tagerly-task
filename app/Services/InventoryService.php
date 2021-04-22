<?php

namespace App\Services;

use App\Repositories\JsonInventoryRepository;

class InventoryService
{
    private $inventoryRepo;

    public function __construct(JsonInventoryRepository $inventoryRepo)
    {
        $this->inventoryRepo = $inventoryRepo;
    }

    public function get()
    {
        return $this->inventoryRepo->get();
    }

    public function search($filters)
    {
        return $this->inventoryRepo->search($filters);
    }

    public function update($id, $data)
    {
        return $this->inventoryRepo->update($id, $data);
    }
}

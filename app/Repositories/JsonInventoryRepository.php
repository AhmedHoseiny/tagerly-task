<?php

namespace App\Repositories;

use App\DataSource\InventoryDataSource;
use App\Repositories\Contracts\InventoryRepositoryInterface;
use Illuminate\Support\Collection;

class JsonInventoryRepository implements InventoryRepositoryInterface
{
    private $inventoryDataSource;

    public function __construct(InventoryDataSource $inventoryDataSource)
    {
        $this->inventoryDataSource = $inventoryDataSource;
    }

    public function get()
    {
        return $this->inventoryDataSource->get();
    }

    public function search( array $filters)
    {
        $data = $this->inventoryDataSource->readFile();
        $collection = new Collection($data['inventory']);

        if (array_key_exists('product_name', $filters)) {
            $inventory = $this->inventoryDataSource->filterByProductName($filters['product_name'], $collection);
        }
        if (array_key_exists('vendor_name', $filters)) {
            $inventory =  $this->inventoryDataSource->filterByVendorName($filters['vendor_name'], $collection);
        }
        if (array_key_exists('price_range', $filters)) {
            $inventory =  $this->inventoryDataSource->filterByPriceRange($filters['price_range'], $collection);
        }
        if (array_key_exists('sort_by', $filters)) {
            return $this->inventoryDataSource->sort($filters['sort_by'], $inventory);
        }

        return $inventory->all();
    }

    public function update($id, $data)
    {
        return $this->inventoryDataSource->update($id, $data);
    }
}

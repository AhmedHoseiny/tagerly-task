<?php

namespace App\DataSource;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class InventoryDataSource
{
    protected $fileName = 'inventory.json';

    public function readFile()
    {
        $path = storage_path() . "/inventory/".$this->fileName;

        return json_decode(file_get_contents($path), true);
    }

    public function get()
    {
        $data = $this->readFile();
        return new Collection($data['inventory']);
    }

    public function filterByProductName($name, $collection)
    {
        return $collection->where('product_name', $name);
    }

    public function filterByVendorName($name, $collection)
    {
        return $collection->where('vendor_name', $name);
    }

    public function filterByPriceRange($priceRange, $collection)
    {
        if (Str::contains($priceRange, ":")) {
            $priceRange = explode(":", $priceRange);
        }

        return $collection->whereIn('price', $priceRange);
    }

    public function sort($item, $collection)
    {
        return $collection->sortBy($item);
    }

    public function findById($id)
    {
        $inventory = $this->readFile();
        $inventory = new Collection($inventory['inventory']);
        $inventory->where('id', $id);
        return $inventory->first();
    }

    public function update($id, $data)
    {
        $inventory = $this->findById($id);
        $updatedInventory = array_merge($inventory, $data);
        if ($this->writeFile($updatedInventory)) {
            return true;
        }
    }

    public function writeFile($data)
    {
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        return file_put_contents(storage_path("/inventory/".$this->fileName), stripslashes($newJsonString));
    }
}

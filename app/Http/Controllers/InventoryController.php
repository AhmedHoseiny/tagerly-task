<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryIndexRequest;
use App\Http\Requests\InventorySearchRequest;
use App\Http\Requests\InventoryUpdateRequest;
use App\Services\InventoryService;

class InventoryController extends Controller
{
    private $service;

    public function __Construct(InventoryService $service)
    {
        $this->service = $service;
    }

    public function index(InventoryIndexRequest $request)
    {
        return response()->json($this->service->get());
    }

    public function search(InventorySearchRequest $request)
    {
        $filters = $request->only([
            'product_name',
            'vendor_name',
            'price_range',
            'sort_by'
        ]);

        return $this->service->search($filters);
    }

    public function update($id, InventoryUpdateRequest $request)
    {
        $data = $request->only([
            'product_name',
            'vendor_name',
            'price',
            'most_selling',
            'customer_votes'
        ]);

        return $this->service->update($id, $data);
    }
}

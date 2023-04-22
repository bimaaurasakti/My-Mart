<?php

namespace App\Http\Controllers\API;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Services\ItemService;
use Illuminate\Http\Response;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('category')->get();
        return Response::statusOk(ItemResource::collection($items));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        try {
            $this->itemService->create($request);
            return Response::statusOk('', 'Item created successfully.');
        } catch (\Throwable $th) {
            return Response::statusError('Something when wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        return Response::statusOk(new ItemResource($item));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, string $id)
    {
        try {
            $this->itemService->update($request, $id);
            return Response::statusOk('', 'Item updated successfully.');
        } catch (\Throwable $th) {
            return Response::statusError('Something when wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->itemService->delete($id);
            return Response::statusOk('', 'Item deleted successfully.');
        } catch (\Throwable $th) {
            return Response::statusError('Something when wrong.');
        }
    }
}

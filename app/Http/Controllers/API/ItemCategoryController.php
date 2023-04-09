<?php

namespace App\Http\Controllers\API;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Services\ItemCategoryService;
use App\Http\Requests\ItemCategoryRequest;
use App\Http\Resources\ItemCategoryResource;

class ItemCategoryController extends Controller
{
    protected $itemCategoryService;

    public function __construct(ItemCategoryService $itemCategoryService)
    {
        $this->itemCategoryService = $itemCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ItemCategory::get();
        return Response::statusOk(ItemCategoryResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemCategoryRequest $request)
    {
        try {
            $this->itemCategoryService->create($request);
            return Response::statusOk('', 'Category created successfully.');
        } catch (\Throwable $th) {
            return Response::statusError('Something when wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemCategoryRequest $request, string $id)
    {
        try {
            $this->itemCategoryService->update($request, $id);
            return Response::statusOk('', 'Category updated successfully.');
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
            $this->itemCategoryService->delete($id);
            return Response::statusOk('', 'Category deleted successfully.');
        } catch (\Throwable $th) {
            return Response::statusError('Something when wrong.');
        }
    }
}

<?php

namespace App\Services;

use Exception;
use App\Models\ItemCategory;
use App\Http\Requests\ItemCategoryRequest;

class ItemCategoryService
{
    public function create(ItemCategoryRequest $request)
    {
        ItemCategory::create([
            'parent_category_id' => $request->category,
            'name' => $request->name,
        ]);
    }

    public function update(ItemCategoryRequest $request, string $id)
    {
        $item = ItemCategory::find($id);
        $item->parent_category_id = $request->category ?? null;
        $item->name = $request->name;
        $item->save();
    }

    public function delete(string $id)
    {
        $category = ItemCategory::find($id);
        if ($category->isUsed) {
            throw new Exception("Category cannot be delete because still in use.");
        }
        $category->delete();
    }
}

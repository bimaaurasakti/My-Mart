<?php

namespace App\Http\Controllers;

use App\Dictionaries\FormActionDictionary;
use App\Http\Requests\ItemCategoryRequest;
use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ItemCategory::get();
        return view('item-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryList = ItemCategory::get();
        $action = FormActionDictionary::ACTION_CREATE;

        return view('item-category.form', compact('categoryList', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemCategoryRequest $request)
    {
        ItemCategory::create([
            'parent_category_id' => $request->category,
            'name' => $request->name,
        ]);

        return redirect()->route('item-categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = ItemCategory::find($id);
        $categoryList = ItemCategory::get();
        $action = FormActionDictionary::ACTION_UPDATE;

        return view('item-category.form', compact('category', 'categoryList', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = ItemCategory::find($id);
        $categoryList = ItemCategory::get();
        $action = FormActionDictionary::ACTION_UPDATE;

        return view('item-category.form', compact('category', 'categoryList', 'action'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = ItemCategory::find($id);
        $item->parent_category_id = $request->category ?? null;
        $item->name = $request->name;
        $item->save();

        return back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ItemCategory::with(['items', 'children'])->find($id);

        if ($category->isUsed) {
            return redirect()->route('item-categories.index')->with('failed', 'Category cannot be delete because still in use.');
        }
        $category->delete();

        return redirect()->route('item-categories.index')->with('success', 'Category deleted successfully.');
    }
}

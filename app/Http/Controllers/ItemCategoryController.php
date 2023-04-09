<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use App\Services\ItemCategoryService;
use App\Dictionaries\FormActionDictionary;
use App\Http\Requests\ItemCategoryRequest;

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
        try {
            $this->itemCategoryService->create($request);
            return redirect()->route('item-categories.index')->with('success', 'Category created successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('item-categories.index')->with('failed', 'Something when wrong.');
        }
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
    public function update(ItemCategoryRequest $request, string $id)
    {
        try {
            $this->itemCategoryService->update($request, $id);
            return redirect()->back()->with('success', 'Category updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('item-categories.index')->with('failed', 'Something when wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->itemCategoryService->delete($id);
            return redirect()->route('item-categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('item-categories.index')->with('failed', $th->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Services\ItemService;
use App\Dictionaries\FormActionDictionary;

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
        return view('item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = new Item();
        $categories = ItemCategory::get();
        $action = FormActionDictionary::ACTION_CREATE;

        return view('item.form', compact('item', 'categories', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        try {
            $this->itemService->create($request);
            return redirect()->route('items.index')->with('success', 'Item created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Something when wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        $categories = ItemCategory::get();
        $action = FormActionDictionary::ACTION_UPDATE;

        return view('item.form', compact('item', 'categories', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::find($id);
        $categories = ItemCategory::get();
        $action = FormActionDictionary::ACTION_UPDATE;

        return view('item.form', compact('item', 'categories', 'action'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, string $id)
    {
        try {
            $this->itemService->update($request, $id);
            return redirect()->back()->with('success', 'Item updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Something when wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->itemService->delete($id);
            return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Something when wrong.');
        }
    }
}

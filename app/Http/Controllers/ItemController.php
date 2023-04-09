<?php

namespace App\Http\Controllers;

use App\Dictionaries\FormActionDictionary;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
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
        Item::create([
            'item_category_id' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
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
        $item = Item::find($id);
        $item->item_category_id = $request->category;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->save();

        return back()->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}

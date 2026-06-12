<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemCategory;
use App\Models\Item;
use Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    /** List only the items/products assigned to this supplier */
    public function index()
    {
        $supplier   = Auth::guard('supplier')->user();
        $itemIds    = is_array($supplier->items) ? $supplier->items : [];
        $items      = Item::whereIn('id', $itemIds)->with(['category', 'stocks'])->orderBy('name')->paginate(20);
        
        $all_categories = ItemCategory::where('status', 1)->orderBy('title')->get();
        $all_items = Item::where('status', 1)->with('category')->orderBy('name')->get();

        return view('supplier.product.item.index', compact('supplier', 'items', 'all_categories', 'all_items'));
    }

    public function create()
    {
        $supplier = Auth::guard('supplier')->user();
        return view('supplier.product.item.create', compact('supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:item_categories,id',
            'product_id'   => 'nullable|integer',
            'items'        => 'nullable|string|max:191',
            'description'  => 'nullable|string',
        ]);

        $supplier = Auth::guard('supplier')->user();
        $itemIds  = is_array($supplier->items) ? $supplier->items : [];

        $productId = $request->product_id;

        if ($productId) {
            $item = Item::findOrFail($productId);
            // Update description if provided
            $item->update(['description' => $request->description]);
        } else {
            $item = Item::where('name', 'like', $request->product_name)
                ->where('category_id', $request->category_id)
                ->first();
            
            if (!$item) {
                $item = Item::create([
                    'name'        => $request->product_name,
                    'category_id' => $request->category_id,
                    'unit'        => $request->items,
                    'description' => $request->description,
                    'status'      => 1,
                ]);
            } else {
                // Update description if item already exists
                $item->update(['description' => $request->description]);
            }
        }

        if (in_array($item->id, $itemIds)) {
            return redirect()->route('supplier.product.index')
                ->with('error', 'Duplicate product with category can\'t be added here.');
        }

        $itemIds[] = $item->id;
        $supplier->items = array_values($itemIds);
        
        $catIds = Item::whereIn('id', $supplier->items)->pluck('category_id')->unique()->toArray();
        $supplier->categories = array_values($catIds);
        
        $supplier->save();

        return redirect()->route('supplier.product.index')
            ->with('success', 'Product added successfully.');
    }

    public function show($id)
    {
        $supplier = Auth::guard('supplier')->user();
        $item     = Item::findOrFail($id);

        return view('supplier.product.item.show', compact('supplier', 'item'));
    }

    public function edit($id)
    {
        $supplier = Auth::guard('supplier')->user();
        $item     = Item::findOrFail($id);
        $categories = ItemCategory::where('status', 1)->orderBy('title')->get();

        return view('supplier.product.item.edit', compact('supplier', 'item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:item_categories,id',
            'status'      => 'required|in:0,1',
            'description' => 'nullable|string',
        ]);

        $supplier = Auth::guard('supplier')->user();
        $itemIds  = is_array($supplier->items) ? $supplier->items : [];

        // Check if there is an existing item with the same name and category in the system
        $existingItem = Item::where('name', 'like', $request->name)
            ->where('category_id', $request->category_id)
            ->where('id', '!=', $id)
            ->first();

        if ($existingItem) {
            // If the supplier already has the existing item in their list
            if (in_array($existingItem->id, $itemIds)) {
                return redirect()->back()
                    ->with('error', 'Duplicate product with category can\'t be added here.')
                    ->withInput();
            }

            // Otherwise, swap the old item ID with the existing item ID in the supplier's list
            $itemIds = array_values(array_filter($itemIds, fn($i) => $i != $id));
            $itemIds[] = $existingItem->id;
            $supplier->items = array_values($itemIds);

            // Sync categories
            $catIds = Item::whereIn('id', $supplier->items)->pluck('category_id')->unique()->toArray();
            $supplier->categories = array_values($catIds);
            $supplier->save();

            return redirect()->route('supplier.product.index')
                ->with('success', 'Product updated successfully.');
        }

        // If no existing item matches, update the current item
        $item = Item::findOrFail($id);
        $item->update([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'status'      => $request->status,
            'description' => $request->description,
        ]);

        // Just in case category changed, sync supplier categories
        $catIds = Item::whereIn('id', $supplier->items)->pluck('category_id')->unique()->toArray();
        $supplier->categories = array_values($catIds);
        $supplier->save();

        return redirect()->route('supplier.product.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $supplier = Auth::guard('supplier')->user();
        $itemIds  = is_array($supplier->items) ? $supplier->items : [];
        
        // Remove item from supplier's selected items list
        $itemIds  = array_values(array_filter($itemIds, fn($i) => $i != $id));
        $supplier->items = $itemIds;
        
        // Sync categories
        if (!empty($supplier->items)) {
            $catIds = Item::whereIn('id', $supplier->items)->pluck('category_id')->unique()->toArray();
            $supplier->categories = array_values($catIds);
        } else {
            $supplier->categories = [];
        }
        
        $supplier->save();

        return redirect()->route('supplier.product.index')
            ->with('success', 'Product removed successfully.');
    }
}

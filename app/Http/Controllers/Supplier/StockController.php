<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemStock;
use Auth;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    public function index()
    {
        $supplier = Auth::guard('supplier')->user();
        
        $stocks = ItemStock::where('supplier_id', $supplier->id)
            ->with(['item', 'store'])
            ->orderBy('id', 'desc')
            ->paginate(20);
            
        return view('supplier.stock.index', compact('supplier', 'stocks'));
    }

    public function create()
    {
        $supplier = Auth::guard('supplier')->user();
        $items = \App\Models\Item::whereIn('id', is_array($supplier->items) ? $supplier->items : [])->orderBy('name', 'asc')->get();
        $stores = \App\Models\ItemStore::where('status', '1')->orderBy('title', 'asc')->get();

        return view('supplier.stock.create', compact('supplier', 'items', 'stores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id'  => 'required|exists:items,id',
            'store_id' => 'required|exists:item_stores,id',
            'quantity' => 'required|numeric|min:1',
            'price'    => 'required|numeric|min:0',
            'date'     => 'required|date',
            'payment_method' => 'nullable',
            'description' => 'nullable|string',
        ]);

        $supplier = Auth::guard('supplier')->user();

        $stock = new ItemStock();
        $stock->item_id = $request->item_id;
        $stock->supplier_id = $supplier->id;
        $stock->store_id = $request->store_id;
        $stock->quantity = $request->quantity;
        $stock->price = $request->price;
        $stock->date = $request->date;
        $stock->payment_method = $request->payment_method ?? 1;
        $stock->description = $request->description;
        $stock->status = 1;
        $stock->created_by = 1; // Assuming 1 or maybe we don't need created_by for supplier
        $stock->save();

        return redirect()->route('supplier.stock.index')->with('success', 'Stock added successfully.');
    }

    public function edit($id)
    {
        $supplier = Auth::guard('supplier')->user();
        $stock = ItemStock::where('supplier_id', $supplier->id)->findOrFail($id);
        
        $items = \App\Models\Item::whereIn('id', is_array($supplier->items) ? $supplier->items : [])->orderBy('name', 'asc')->get();
        $stores = \App\Models\ItemStore::where('status', '1')->orderBy('title', 'asc')->get();

        return view('supplier.stock.edit', compact('supplier', 'stock', 'items', 'stores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_id'  => 'required|exists:items,id',
            'store_id' => 'required|exists:item_stores,id',
            'quantity' => 'required|numeric|min:1',
            'price'    => 'required|numeric|min:0',
            'date'     => 'required|date',
            'payment_method' => 'nullable',
            'description' => 'nullable|string',
        ]);

        $supplier = Auth::guard('supplier')->user();
        $stock = ItemStock::where('supplier_id', $supplier->id)->findOrFail($id);

        $stock->item_id = $request->item_id;
        $stock->store_id = $request->store_id;
        $stock->quantity = $request->quantity;
        $stock->price = $request->price;
        $stock->date = $request->date;
        $stock->payment_method = $request->payment_method ?? $stock->payment_method;
        $stock->description = $request->description;
        $stock->save();

        return redirect()->route('supplier.stock.index')->with('success', 'Stock updated successfully.');
    }

    public function destroy($id)
    {
        $supplier = Auth::guard('supplier')->user();
        $stock = ItemStock::where('supplier_id', $supplier->id)->findOrFail($id);
        $stock->delete();

        return redirect()->route('supplier.stock.index')->with('success', 'Stock deleted successfully.');
    }
}

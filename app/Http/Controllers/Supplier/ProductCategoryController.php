<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemCategory;
use App\Models\Item;
use Auth;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    /** List only the categories assigned to this supplier */
    public function index()
    {
        $supplier   = Auth::guard('supplier')->user();
        $catIds     = is_array($supplier->categories) ? $supplier->categories : [];
        $categories = ItemCategory::whereIn('id', $catIds)->orderBy('title')->paginate(20);

        return view('supplier.product.category.index', compact('supplier', 'categories'));
    }

    public function create()
    {
        $supplier = Auth::guard('supplier')->user();
        return view('supplier.product.category.create', compact('supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255|unique:item_categories,title',
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1',
        ]);

        $category = ItemCategory::create([
            'title'       => $request->title,
            'slug'        => \Str::slug($request->title),
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        // Attach this new category to the supplier
        $supplier   = Auth::guard('supplier')->user();
        $catIds     = is_array($supplier->categories) ? $supplier->categories : [];
        $catIds[]   = $category->id;
        $supplier->categories = array_unique($catIds);
        $supplier->save();

        return redirect()->route('supplier.product.category.index')
            ->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $supplier = Auth::guard('supplier')->user();
        $category = ItemCategory::findOrFail($id);
        $items    = Item::where('category_id', $id)->where('status', 1)->get();

        return view('supplier.product.category.show', compact('supplier', 'category', 'items'));
    }

    public function edit($id)
    {
        $supplier = Auth::guard('supplier')->user();
        $category = ItemCategory::findOrFail($id);

        return view('supplier.product.category.edit', compact('supplier', 'category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255|unique:item_categories,title,' . $id,
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1',
        ]);

        $category = ItemCategory::findOrFail($id);
        $category->update([
            'title'       => $request->title,
            'slug'        => \Str::slug($request->title),
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return redirect()->route('supplier.product.category.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = ItemCategory::findOrFail($id);

        // Remove from supplier's categories list
        $supplier = Auth::guard('supplier')->user();
        $catIds   = is_array($supplier->categories) ? $supplier->categories : [];
        $catIds   = array_values(array_filter($catIds, fn($c) => $c != $id));
        $supplier->categories = $catIds;
        $supplier->save();

        $category->delete();

        return redirect()->route('supplier.product.category.index')
            ->with('success', 'Category deleted successfully.');
    }
}

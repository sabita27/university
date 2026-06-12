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

    public function index()
    {
        $supplier   = Auth::guard('supplier')->user();
        $catIds     = is_array($supplier->categories) ? $supplier->categories : [];
        $categories = ItemCategory::with('items')->whereIn('id', $catIds)->orderBy('title')->paginate(20);

        return view('supplier.product.category.index', compact('supplier', 'categories'));
    }

    public function create()
    {
        $supplier = Auth::guard('supplier')->user();
        $allCategories = \App\Models\ItemCategory::where('status', 1)->orderBy('title')->get();
        $selectedCategories = is_array($supplier->categories) ? $supplier->categories : [];
        
        return view('supplier.product.category.create', compact('supplier', 'allCategories', 'selectedCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categories' => 'nullable|array',
            'categories.*' => 'exists:item_categories,id',
            'new_category_title' => 'nullable|string|max:255',
            'new_category_description' => 'nullable|string'
        ]);

        $supplier = Auth::guard('supplier')->user();
        $selectedCategories = $request->categories ?? [];

        if ($request->filled('new_category_title')) {
            $slug = \Str::slug($request->new_category_title);
            // Check if it already exists
            $existing = ItemCategory::where('slug', $slug)->first();
            if ($existing) {
                if (!in_array($existing->id, $selectedCategories)) {
                    $selectedCategories[] = (string)$existing->id;
                }
            } else {
                $newCategory = ItemCategory::create([
                    'title' => $request->new_category_title,
                    'slug' => $slug,
                    'description' => $request->new_category_description,
                    'status' => 1
                ]);
                $selectedCategories[] = (string)$newCategory->id;
            }
        }

        $supplier->categories = array_values(array_unique($selectedCategories));
        $supplier->save();

        return redirect()->route('supplier.product.category.index')
            ->with('success', 'Categories updated successfully.');
    }

    public function destroy($id)
    {
        $category = ItemCategory::findOrFail($id);

        $supplier = Auth::guard('supplier')->user();
        $catIds   = is_array($supplier->categories) ? $supplier->categories : [];
        $catIds   = array_values(array_filter($catIds, fn($c) => $c != $id));
        $supplier->categories = $catIds;
        $supplier->save();

        // Do not delete the global category, just remove from supplier's selected categories
        // $category->delete(); 

        return redirect()->route('supplier.product.category.index')
            ->with('success', 'Category removed successfully.');
    }
}

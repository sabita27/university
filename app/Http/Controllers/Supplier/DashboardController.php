<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemSupplier;
use App\Models\ItemCategory;
use App\Models\ItemStock;
use App\Models\Item;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $supplier = Auth::guard('supplier')->user();
        
        $categories = is_array($supplier->categories) ? $supplier->categories : [];
        
        // Supplier-specific counts
        $myCategoriesCount = count($categories);
        $myItemsCount = Item::whereIn('category_id', $categories)->where('status', 1)->count();
        $totalStocks = ItemStock::where('supplier_id', $supplier->id)->count();
        $totalPurchaseAmount = ItemStock::where('supplier_id', $supplier->id)->sum('price');
        
        // Items this supplier can supply
        $myItems = Item::whereIn('category_id', $categories)
            ->where('status', 1)
            ->with('category')
            ->orderBy('name', 'asc')
            ->get();
        
        // Monthly supply count data for chart (last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = ItemStock::where('supplier_id', $supplier->id)
                ->whereYear('date', $month->year)
                ->whereMonth('date', $month->month)
                ->count();
            $monthlyData[] = [
                'label' => $month->format('M'),
                'count' => $count
            ];
        }

        // Doughnut Chart - My Supply Items by Category
        $doughnutLabels = [];
        $doughnutCounts = [];
        $categoryBreakdown = ItemCategory::whereIn('id', $categories)->where('status', 1)->get();
        foreach ($categoryBreakdown as $cat) {
            $itemCount = Item::where('category_id', $cat->id)->where('status', 1)->count();
            if ($itemCount > 0) {
                $doughnutLabels[] = $cat->title;
                $doughnutCounts[] = $itemCount;
            }
        }
        if (empty($doughnutLabels)) {
            $doughnutLabels = ['No Items'];
            $doughnutCounts = [0];
        }

        return view('supplier.dashboard.index', compact(
            'supplier',
            'myCategoriesCount',
            'myItemsCount',
            'totalStocks',
            'totalPurchaseAmount',
            'myItems',
            'monthlyData',
            'doughnutLabels',
            'doughnutCounts'
        ));
    }
}


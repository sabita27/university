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
}

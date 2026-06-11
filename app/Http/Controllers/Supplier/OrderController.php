<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procurement;
use Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    public function index()
    {
        $supplier = Auth::guard('supplier')->user();

        // Active/Pending orders (status = 1)
        $activeOrders = Procurement::where('status', Procurement::STATUS_PENDING)
            ->orderBy('id', 'desc')
            ->get();

        // All orders for the quotation table
        $orders = Procurement::orderBy('id', 'desc')
            ->paginate(20);

        return view('supplier.order.index', compact('supplier', 'activeOrders', 'orders'));
    }
}

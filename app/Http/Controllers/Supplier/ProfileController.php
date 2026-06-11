<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    public function index()
    {
        $supplier = Auth::guard('supplier')->user();
        return view('supplier.profile.index', compact('supplier'));
    }
}

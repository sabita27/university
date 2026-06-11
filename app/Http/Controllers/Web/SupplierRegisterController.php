<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemSupplier;
use App\Models\ItemCategory;
use Toastr;

class SupplierRegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Register As Supplier';
        $data['categories'] = ItemCategory::where('status', 1)->orderBy('title', 'asc')->get();

        return view('web.supplier-register', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:item_suppliers,title',
            'email' => 'required|email',
            'phone' => 'required',
            'categories' => 'required|array',
            'password' => 'required|min:6|confirmed',
        ]);

        // Insert Data
        $itemSupplier = new ItemSupplier;
        $itemSupplier->title = $request->title;
        $itemSupplier->email = $request->email;
        $itemSupplier->phone = $request->phone;
        $itemSupplier->password = bcrypt($request->password);
        $itemSupplier->categories = $request->categories;
        $itemSupplier->status = 0; // Default pending status or maybe 1 depending on requirement
        $itemSupplier->save();

        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route('login');
    }
}

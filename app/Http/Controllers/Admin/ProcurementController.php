<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Toastr;

class ProcurementController extends Controller
{
    /**
     * Module Data
     */
    protected $title;
    protected $route;
    protected $view;
    protected $path;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = 'Procurements';
        $this->route = 'admin.procurement';
        $this->view = 'admin.procurement';
        $this->path = 'procurement';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $currentUser = auth()->user();
        
        $query = \App\Models\Procurement::query();
        
        // Filter procurements for non-admin users to show only their assigned/created requests
        if ($currentUser && isset($currentUser->is_admin) && $currentUser->is_admin != 1) {
            $query->where(function($q) use ($currentUser) {
                $q->where('staff_id', $currentUser->id)
                  ->orWhere('auth_id', $currentUser->id);
            });
        }
        
        $data['rows'] = $query->orderBy('id', 'desc')->get();

        return view($this->view.'.index', $data);
    }

    /** Show the form for creating a new procurement */
    public function create()
    {
        $data['title'] = $this->title . ' - Create';
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['departments'] = \App\Models\Department::where('status', 1)->orderBy('title', 'asc')->get();
        $data['suppliers'] = \App\User::where('status', 1)->orderBy('first_name', 'asc')->get();
        $data['asset_types'] = \App\Models\Item::where('status', 1)->orderBy('name', 'asc')->get();
        $data['asset_brands'] = \App\Models\ItemCategory::where('status', 1)->orderBy('title', 'asc')->get();
        

        // Generate sequential Request Number
        $year = date('Y');
        $nextId = \App\Models\Procurement::count() + 1;
        $data['generated_procurement_number'] = 'PR-' . $year . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view($this->view.'.create', $data);
    }

    /** Store a newly created procurement */
    public function store(Request $request)
    {
        $request->validate([
            'procurement_number' => 'required|max:191|unique:procurements,procurement_number',
            //            'email' => 'required|email|max:191',
            'request_date' => 'required|date',
            //            'delivery_date' => 'required|date|after_or_equal:request_date',
            'purpose' => 'nullable',
            'assets' => 'nullable',
            'urgency' => 'required|string',
            'urgency_reason' => 'nullable|string',
            'staff_id' => 'nullable|exists:users,id',
            'product_id' => 'nullable|exists:items,id',
        ]);

        $procurement = new \App\Models\Procurement();
        $procurement->procurement_number = $request->procurement_number;
        if (!empty($request->staff_id)) {
            $staff = \App\User::find($request->staff_id);
            $procurement->name = $staff ? trim($staff->first_name . ' ' . $staff->last_name) : '';
        } else {
            $auth = auth()->user();
            $procurement->name = $auth ? trim($auth->first_name . ' ' . $auth->last_name) : '';
        }
        
        $procurement->purpose = $request->purpose;
        $procurement->request_date = $request->request_date;
        $procurement->urgency = $request->urgency;
        $procurement->urgency_reason = $request->urgency_reason;
        $procurement->staff_id = $request->staff_id;
        
        $assets = $request->assets;
        if (is_string($assets)) {
            $assets = json_decode($assets, true);
        }
        $procurement->assets = $assets ?: [];
        
        // Auto-populate product_id from the first asset in the assets list
        if ($request->filled('product_id')) {
            $procurement->product_id = $request->product_id;
        } else {
            $procurement->product_id = (!empty($procurement->assets) && is_array($procurement->assets)) ? ((int)($procurement->assets[0]['type_id'] ?? 0) ?: null) : null;
        }
        
        $procurement->auth_id = auth()->id();
        
        $procurement->status = \App\Models\Procurement::STATUS_PENDING;
        $procurement->save();

        Toastr::success(__('msg_created_successfully'), __('msg_success'));
        return redirect()->route($this->route . '.index');
    }

    /** Show the form for editing a procurement */
    public function edit($id)
    {
        $data['title'] = $this->title . ' - Edit';
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['row'] = \App\Models\Procurement::findOrFail($id);

        $data['departments'] = \App\Models\Department::where('status', 1)->orderBy('title', 'asc')->get();
        $data['suppliers'] = \App\User::where('status', 1)->orderBy('first_name', 'asc')->get();
        $data['asset_types'] = \App\Models\Item::where('status', 1)->orderBy('name', 'asc')->get();
        $data['asset_brands'] = \App\Models\ItemCategory::where('status', 1)->orderBy('title', 'asc')->get();

        return view($this->view.'.edit', $data);
    }

    /** Update a procurement */
    public function update(Request $request, $id)
    {
        $request->validate([
            'procurement_number' => 'required|max:191|unique:procurements,procurement_number,' . $id,
            'request_date' => 'required|date',
            'purpose' => 'nullable',
            'assets' => 'nullable',
            'status' => 'required|in:0,1,2',
            'urgency' => 'required|string',
            'urgency_reason' => 'nullable|string',
            'staff_id' => 'nullable|exists:users,id',
            'product_id' => 'nullable|exists:items,id',
        ]);

        $procurement = \App\Models\Procurement::findOrFail($id);
        $procurement->procurement_number = $request->procurement_number;
        if (!empty($request->staff_id)) {
            $staff = \App\User::find($request->staff_id);
            $procurement->name = $staff ? trim($staff->first_name . ' ' . $staff->last_name) : '';
        } else {
            $auth = auth()->user();
            $procurement->name = $auth ? trim($auth->first_name . ' ' . $auth->last_name) : '';
        }

        $procurement->purpose = $request->purpose;
        $procurement->request_date = $request->request_date;
        $procurement->urgency = $request->urgency;
        $procurement->urgency_reason = $request->urgency_reason;
        $procurement->status = $request->status;
        $procurement->staff_id = $request->staff_id;

        $assets = $request->assets;
        if (is_string($assets)) {
            $assets = json_decode($assets, true);
        }
        $procurement->assets = $assets ?: [];

        // Auto-populate product_id from the first asset in the assets list
        if ($request->filled('product_id')) {
            $procurement->product_id = $request->product_id;
        } else {
            $procurement->product_id = (!empty($procurement->assets) && is_array($procurement->assets)) ? ((int)($procurement->assets[0]['type_id'] ?? 0) ?: null) : null;
        }

        $procurement->save();

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect()->route($this->route . '.index');
    }

    /** Delete a procurement */
    public function destroy($id)
    {
        $procurement = \App\Models\Procurement::findOrFail($id);
        $procurement->delete();
        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        return redirect()->back();
    }

    /** Show procurement details */
    public function show($id)
    {
        $data['title'] = $this->title . ' - Details';
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['row'] = \App\Models\Procurement::findOrFail($id);
        return view($this->view.'.show', $data);
    }

    /** Approve a procurement */
    public function approve(Request $request, $id)
    {
        $procurement = \App\Models\Procurement::findOrFail($id);
        $procurement->status = 2; // 2 is Approved
        $procurement->save();

        \Toastr::success('Procurement Approved Successfully', __('msg_success'));
        return redirect()->back();
    }
}

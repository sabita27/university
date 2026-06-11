<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetAssignment;
use App\Models\Asset;
use App\Models\AssetType;
use App\User;
use Illuminate\Http\Request;
use Toastr;

class AssetAssignmentController extends Controller
{
    protected $title = 'Asset Assignment';
    protected $route = 'admin.asset-assignment';
    protected $view  = 'admin.asset.assignment';
    protected $path  = 'asset';

    public function index(Request $request)
    {
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['path']   = $this->path;
        $data['types']  = AssetType::where('status', 1)->orderBy('title')->get();
        $data['users']  = User::orderBy('first_name')->get();

        $query = AssetAssignment::with(['asset.assetType', 'user']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('type')) {
            $query->whereHas('asset', function ($q) use ($request) {
                $q->where('asset_type_id', $request->type);
            });
        }
        if ($request->filled('is_damaged')) {
            $query->where('is_damaged', $request->is_damaged);
        }
        if ($request->filled('is_returned')) {
            $query->where('is_returned', $request->is_returned);
        }
        if ($request->filled('assigned_date')) {
            $query->whereDate('assigned_date', $request->assigned_date);
        }
        if ($request->filled('return_date')) {
            $query->whereDate('return_date', $request->return_date);
        }

        $data['rows'] = $query->orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }

    public function create()
    {
        $data['title']  = $this->title . ' - Assign';
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['path']   = $this->path;
        $data['assets'] = Asset::where('availability_status', 1)->orderBy('name')->get();
        $data['users']  = User::where('status', 1)->orderBy('first_name')->get();

        return view($this->view . '.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id'      => 'required|exists:assets,id',
            'user_id'       => 'required|exists:users,id',
            'assigned_date' => 'required|date',
            'return_date'   => 'nullable|date|after_or_equal:assigned_date',
        ]);

        $row = new AssetAssignment();
        $row->asset_id      = $request->asset_id;
        $row->user_id       = $request->user_id;
        $row->assigned_date = $request->assigned_date;
        $row->return_date   = $request->return_date;
        $row->is_damaged    = 0;
        $row->is_returned   = 0;
        $row->note          = $request->note;
        $row->save();

        // Mark asset as not available
        $asset = Asset::find($request->asset_id);
        if ($asset) {
            $asset->availability_status = 0;
            $asset->save();
        }

        Toastr::success(__('msg_created_successfully'), __('msg_success'));
        return redirect()->route($this->route . '.index');
    }

    public function edit($id)
    {
        $data['title']  = $this->title . ' - Edit';
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['path']   = $this->path;
        $data['row']    = AssetAssignment::findOrFail($id);
        $data['assets'] = Asset::orderBy('name')->get();
        $data['users']  = User::where('status', 1)->orderBy('first_name')->get();

        return view($this->view . '.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'asset_id'      => 'required|exists:assets,id',
            'user_id'       => 'required|exists:users,id',
            'assigned_date' => 'required|date',
            'return_date'   => 'nullable|date|after_or_equal:assigned_date',
        ]);

        $row = AssetAssignment::findOrFail($id);
        $row->asset_id      = $request->asset_id;
        $row->user_id       = $request->user_id;
        $row->assigned_date = $request->assigned_date;
        $row->return_date   = $request->return_date;
        $row->is_damaged    = $request->is_damaged ?? 0;
        $row->is_returned   = $request->is_returned ?? 0;
        $row->note          = $request->note;
        $row->save();

        // If returned, mark asset as available again
        if ($row->is_returned == 1) {
            $asset = Asset::find($row->asset_id);
            if ($asset) {
                $asset->availability_status = 1;
                $asset->save();
            }
        }

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect()->route($this->route . '.index');
    }

    public function destroy($id)
    {
        $row = AssetAssignment::findOrFail($id);

        // Restore asset availability
        $asset = Asset::find($row->asset_id);
        if ($asset && $row->is_returned == 0) {
            $asset->availability_status = 1;
            $asset->save();
        }

        $row->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetType;
use App\Models\AssetBrand;
use Illuminate\Http\Request;
use Toastr;

class AssetController extends Controller
{
    protected $title = 'Assets';
    protected $route = 'admin.asset';
    protected $view  = 'admin.asset.asset';
    protected $path  = 'asset';

    public function index(Request $request)
    {
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['path']   = $this->path;
        $data['types']  = AssetType::where('status', 1)->orderBy('title')->get();
        $data['brands'] = AssetBrand::where('status', 1)->orderBy('title')->get();

        $query = Asset::with(['assetType', 'assetBrand']);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('type')) {
            $query->where('asset_type_id', $request->type);
        }
        if ($request->filled('working_status')) {
            $query->where('working_status', $request->working_status);
        }
        if ($request->filled('availability_status')) {
            $query->where('availability_status', $request->availability_status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('purchased_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('purchased_date', '<=', $request->date_to);
        }

        $data['rows'] = $query->orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }

    public function create()
    {
        $data['title']  = $this->title . ' - Add';
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['path']   = $this->path;
        $data['types']  = AssetType::where('status', 1)->orderBy('title')->get();
        $data['brands'] = AssetBrand::where('status', 1)->orderBy('title')->get();

        return view($this->view . '.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|max:191',
            'asset_type_id'  => 'nullable|exists:asset_types,id',
            'asset_brand_id' => 'nullable|exists:asset_brands,id',
            'purchased_date' => 'nullable|date',
            'purchased_cost' => 'nullable|numeric|min:0',
        ]);

        $row = new Asset();
        $row->name              = $request->name;
        $row->asset_type_id     = $request->asset_type_id;
        $row->asset_brand_id    = $request->asset_brand_id;
        $row->serial_number     = $request->serial_number;
        $row->purchased_date    = $request->purchased_date;
        $row->purchased_cost    = $request->purchased_cost;
        $row->description       = $request->description;
        $row->working_status    = 1;
        $row->availability_status = 1;
        $row->save();

        Toastr::success(__('msg_created_successfully'), __('msg_success'));
        return redirect()->route($this->route . '.index');
    }

    public function show($id)
    {
        $data['title'] = $this->title . ' - Details';
        $data['route'] = $this->route;
        $data['view']  = $this->view;
        $data['path']  = $this->path;
        $data['row']   = Asset::with(['assetType', 'assetBrand', 'assignments.user'])->findOrFail($id);

        return view($this->view . '.show', $data);
    }

    public function edit($id)
    {
        $data['title']  = $this->title . ' - Edit';
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['path']   = $this->path;
        $data['row']    = Asset::findOrFail($id);
        $data['types']  = AssetType::where('status', 1)->orderBy('title')->get();
        $data['brands'] = AssetBrand::where('status', 1)->orderBy('title')->get();

        return view($this->view . '.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'           => 'required|max:191',
            'asset_type_id'  => 'nullable|exists:asset_types,id',
            'asset_brand_id' => 'nullable|exists:asset_brands,id',
            'purchased_date' => 'nullable|date',
            'purchased_cost' => 'nullable|numeric|min:0',
        ]);

        $row = Asset::findOrFail($id);
        $row->name              = $request->name;
        $row->asset_type_id     = $request->asset_type_id;
        $row->asset_brand_id    = $request->asset_brand_id;
        $row->serial_number     = $request->serial_number;
        $row->purchased_date    = $request->purchased_date;
        $row->purchased_cost    = $request->purchased_cost;
        $row->description       = $request->description;
        $row->working_status    = $request->working_status ?? $row->working_status;
        $row->availability_status = $request->availability_status ?? $row->availability_status;
        $row->save();

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect()->route($this->route . '.index');
    }

    public function destroy($id)
    {
        $row = Asset::findOrFail($id);
        $row->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        return redirect()->back();
    }

    public function workingStatus($id)
    {
        $row = Asset::findOrFail($id);
        $row->working_status = $row->working_status == 1 ? 0 : 1;
        $row->save();

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect()->back();
    }

    public function availabilityStatus($id)
    {
        $row = Asset::findOrFail($id);
        $row->availability_status = $row->availability_status == 1 ? 0 : 1;
        $row->save();

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect()->back();
    }
}

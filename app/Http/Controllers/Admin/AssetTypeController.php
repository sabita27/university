<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetType;
use Illuminate\Http\Request;
use Toastr;

class AssetTypeController extends Controller
{
    protected $title = 'Asset Types';
    protected $route = 'admin.asset-type';
    protected $view  = 'admin.asset.type';
    protected $path  = 'asset';

    public function index()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view']  = $this->view;
        $data['path']  = $this->path;
        $data['rows']  = AssetType::withCount('assets')->orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191|unique:asset_types,title',
        ]);

        $row        = new AssetType();
        $row->title  = $request->title;
        $row->status = 1;
        $row->save();

        Toastr::success(__('msg_created_successfully'), __('msg_success'));
        return redirect()->route($this->route . '.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'  => 'required|max:191|unique:asset_types,title,' . $id,
            'status' => 'required|in:0,1',
        ]);

        $row         = AssetType::findOrFail($id);
        $row->title  = $request->title;
        $row->status = $request->status;
        $row->save();

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect()->route($this->route . '.index');
    }

    public function destroy($id)
    {
        $row = AssetType::findOrFail($id);
        $row->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        return redirect()->back();
    }

    public function status($id)
    {
        $row = AssetType::findOrFail($id);
        $row->status = $row->status == 1 ? 0 : 1;
        $row->save();

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect()->back();
    }
}

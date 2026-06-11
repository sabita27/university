<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrmLeadStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;

class CrmLeadStatusController extends Controller
{
    protected $title;
    protected $route;
    protected $view;
    protected $path;
    protected $access;

    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_lead_status', 2);
        $this->route = 'admin.crm.lead-status';
        $this->view = 'admin.crm.lead-status';
        $this->path = 'crm-lead-status';
        $this->access = 'crm-lead-status';

        $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show']]);
        $this->middleware('permission:'.$this->access.'-create', ['only' => ['create','store']]);
        $this->middleware('permission:'.$this->access.'-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        
        $data['rows'] = CrmLeadStatus::orderBy('id', 'asc')->get();

        return view($this->view.'.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191|unique:crm_lead_statuses,title',
            'color' => 'required|max:7',
        ]);
        $leadStatus = new CrmLeadStatus;
        $leadStatus->title = $request->title;
        $leadStatus->slug = Str::slug($request->title, '-');
        $leadStatus->color = $request->color;
        $leadStatus->description = $request->description;
        $leadStatus->save();
        \Toastr::success(__('msg_created_successfully'), __('msg_success'));
        return redirect()->back();
    }
    public function update(Request $request, CrmLeadStatus $leadStatus)
    {
        $request->validate([
            'title' => 'required|max:191|unique:crm_lead_statuses,title,'.$leadStatus->id,
            'color' => 'required|max:7',
        ]);
        $leadStatus->title = $request->title;
        $leadStatus->slug = Str::slug($request->title, '-');
        $leadStatus->color = $request->color;
        $leadStatus->description = $request->description;
        $leadStatus->status = $request->status;
        $leadStatus->save();
        \Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect()->back();
    }
    public function destroy(CrmLeadStatus $leadStatus)
    {
        $leadStatus->delete();
        \Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        return redirect()->back();
    }
}

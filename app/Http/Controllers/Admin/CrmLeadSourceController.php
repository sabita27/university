<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrmLeadSource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;

class CrmLeadSourceController extends Controller
{
    /**
     * Module Data
     */
    protected $title;
    protected $route;
    protected $view;
    protected $path;
    protected $access;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_lead_source', 2);
        $this->route = 'admin.crm.lead-source';
        $this->view = 'admin.crm.lead-source';
        $this->path = 'crm-lead-source';
        $this->access = 'crm-lead-source';

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
        
        $data['rows'] = CrmLeadSource::orderBy('title', 'asc')->get();

        return view($this->view.'.index', $data);
    }

    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:crm_lead_sources,title',
        ]);

        // Insert Data
        $leadSource = new CrmLeadSource;
        $leadSource->title = $request->title;
        $leadSource->slug = Str::slug($request->title, '-');
        $leadSource->description = $request->description;
        $leadSource->save();

        \Toastr::success(__('msg_created_successfully'), __('msg_success'));
        return redirect()->back();
    }
    public function update(Request $request, CrmLeadSource $leadSource)
    {
        $request->validate([
            'title' => 'required|max:191|unique:crm_lead_sources,title,'.$leadSource->id,
        ]);
        $leadSource->title = $request->title;
        $leadSource->slug = Str::slug($request->title, '-');
        $leadSource->description = $request->description;
        $leadSource->status = $request->status;
        $leadSource->save();
        \Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect()->back();
    }
    public function destroy(CrmLeadSource $leadSource)
    {
        $leadSource->delete();
        \Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        return redirect()->back();
    }
}

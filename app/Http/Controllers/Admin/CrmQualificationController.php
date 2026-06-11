<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrmQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;

class CrmQualificationController extends Controller
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
        $this->title = trans_choice('module_qualification', 2);
        $this->route = 'admin.crm.qualification';
        $this->view = 'admin.crm.qualification';
        $this->path = 'crm-qualification';
        $this->access = 'crm-qualification';

        $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show']]);
        $this->middleware('permission:'.$this->access.'-create', ['only' => ['create','store']]);
        $this->middleware('permission:'.$this->access.'-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
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
        $data['access'] = $this->access;
        
        $data['rows'] = CrmQualification::orderBy('title', 'asc')->get();

        return view($this->view.'.index', $data);
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
            'title' => 'required|max:191|unique:crm_qualifications,title',
        ]);

        // Insert Data
        $qualification = new CrmQualification;
        $qualification->title = $request->title;
        $qualification->slug = Str::slug($request->title, '-');
        $qualification->description = $request->description;
        $qualification->save();

        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CrmQualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CrmQualification $qualification)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:crm_qualifications,title,'.$qualification->id,
        ]);

        // Update Data
        $qualification->title = $request->title;
        $qualification->slug = Str::slug($request->title, '-');
        $qualification->description = $request->description;
        $qualification->status = $request->status;
        $qualification->save();

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CrmQualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(CrmQualification $qualification)
    {
        $qualification->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }
}

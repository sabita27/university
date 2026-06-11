<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CrmLead;
use App\Models\CrmLeadSource;
use App\Models\CrmLeadStatus;
use App\Models\CrmQualification;
use App\Models\CrmLeadFollowUp;
use App\Models\Program;
use App\User;
use Toastr;
use Auth;

class CrmLeadController extends Controller
{
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
        $this->title = 'Leads';
        $this->route = 'admin.crm.lead';
        $this->view = 'admin.crm.lead';
        $this->path = 'crm-lead';
        $this->access = 'crm-lead';

        $this->middleware('auth');
        $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show','enquiry']]);
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

        $rows = CrmLead::with(['program', 'leadStatus', 'source', 'staff', 'followUps.creator']);
        
        // Filter leads for non-admin users to show only assigned leads
        $currentUser = auth()->user();
        if ($currentUser && isset($currentUser->is_admin) && $currentUser->is_admin != 1) {
            $rows->where('counsellor_id', $currentUser->id);
        }

        $data['rows'] = $rows->orderBy('id', 'desc')->get();
        $data['sources'] = CrmLeadSource::where('status', '1')->orderBy('title', 'asc')->get();
        $data['statuses'] = CrmLeadStatus::where('status', '1')->orderBy('id', 'asc')->get();
        $data['programs'] = Program::where('status', '1')->orderBy('title', 'asc')->get();
        $data['qualifications'] = CrmQualification::where('status', '1')->orderBy('id', 'asc')->get();
        $data['users'] = User::orderBy('first_name', 'asc')->get();

        return view($this->view.'.index', $data);
    }

    public function enquiry(Request $request)
    {
        $data['title'] = "Lead Enquiry";
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        $rows = CrmLead::with(['program', 'leadStatus', 'source', 'staff', 'followUps.creator']);
        
        // Filter leads for non-admin users to show only assigned leads
        $currentUser = auth()->user();
        if ($currentUser && isset($currentUser->is_admin) && $currentUser->is_admin != 1) {
            $rows->where('counsellor_id', $currentUser->id);
        }

        // Apply filters from request
        if ($request->has('name') && $request->name != '') {
            $rows->where('name', 'like', '%'.$request->name.'%');
        }
        if ($request->has('email') && $request->email != '') {
            $rows->where('email', 'like', '%'.$request->email.'%');
        }
        if ($request->has('status') && $request->status != '') {
            $rows->where('lead_status_id', $request->status);
        }
        if ($request->has('agent') && $request->agent != '') {
            $rows->where('counsellor_id', $request->agent);
        }

        // Follow Up Filter
        if ($request->has('follow_up') && $request->follow_up == '1') {
            $rows->whereHas('followUps', function($q) {
                $q->whereNotNull('follow_up_date');
            });
        }

        $data['rows'] = $rows->orderBy('id', 'desc')->get();
        $data['sources'] = CrmLeadSource::where('status', '1')->orderBy('title', 'asc')->get();
        $data['statuses'] = CrmLeadStatus::where('status', '1')->orderBy('id', 'asc')->get();
        $data['programs'] = Program::where('status', '1')->orderBy('title', 'asc')->get();
        $data['qualifications'] = CrmQualification::where('status', '1')->orderBy('id', 'asc')->get();
        $data['users'] = User::orderBy('first_name', 'asc')->get();

        return view($this->view.'.enquiry', $data);
    }

    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'educational_qualification' => 'required',
            'board' => 'required',
            'total_mark' => 'required',
            'total_percentage' => 'required',
            'program_id' => 'required',
            'lead_source_id' => 'required',
            'lead_status_id' => 'required',
            'description' => 'required',
        ]);

        // Insert Data
        $crmLead = new CrmLead();
        $crmLead->name = $request->name;
        $crmLead->father_name = $request->father_name;
        $crmLead->email = $request->email;
        $crmLead->phone = $request->phone;
        $crmLead->educational_qualification = $request->educational_qualification;
        $crmLead->program_id = $request->program_id;
        $crmLead->lead_source_id = $request->lead_source_id;
        $crmLead->lead_status_id = $request->lead_status_id;
        $crmLead->description = $request->description;
        $crmLead->created_by = Auth::guard('web')->user()->id;
        $crmLead->board = $request->board;
        $crmLead->total_mark = $request->total_mark;
        $crmLead->total_percentage = $request->total_percentage;
        $crmLead->counsellor_id = $request->counsellor_id;
        $crmLead->save();

        // Store Follow-up History
        if ($request->follow_up_date || $request->follow_up_note) {
            CrmLeadFollowUp::create([
                'lead_id' => $crmLead->id,
                'follow_up_date' => $request->follow_up_date,
                'follow_up_note' => $request->follow_up_note,
                'created_by' => Auth::guard('web')->user()->id,
            ]);
        }


        \Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // Field Validation
        $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'educational_qualification' => 'required',
            'board' => 'required',
            'total_mark' => 'required',
            'total_percentage' => 'required',
            'program_id' => 'required',
            'lead_source_id' => 'required',
            'lead_status_id' => 'required',
            'description' => 'required',
        ]);

        // Update Data
        $crmLead = CrmLead::findOrFail($id);
        $crmLead->name = $request->name;
        $crmLead->father_name = $request->father_name;
        $crmLead->email = $request->email;
        $crmLead->phone = $request->phone;
        $crmLead->educational_qualification = $request->educational_qualification;
        $crmLead->board = $request->board;
        $crmLead->total_mark = $request->total_mark;
        $crmLead->total_percentage = $request->total_percentage;
        $crmLead->program_id = $request->program_id;
        $crmLead->lead_source_id = $request->lead_source_id;
        $crmLead->lead_status_id = $request->lead_status_id;
        $crmLead->description = $request->description;
        $crmLead->status = $request->status ?? 1;
        $crmLead->counsellor_id = $request->counsellor_id;
        $crmLead->save();

        // Store Follow-up History
        if ($request->follow_up_date || $request->follow_up_note) {
            CrmLeadFollowUp::create([
                'lead_id' => $crmLead->id,
                'follow_up_date' => $request->follow_up_date,
                'follow_up_note' => $request->follow_up_note,
                'created_by' => Auth::guard('web')->user()->id,
            ]);
        }


        \Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    public function updateStatus(Request $request, $id)
    {
        $crmLead = CrmLead::findOrFail($id);
        if ($request->has('status_id') && $request->status_id !== null) {
            $crmLead->lead_status_id = $request->status_id;
            $crmLead->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        }
        
        return response()->json(['success' => false, 'message' => 'Invalid status ID'], 400);
    }

    public function destroy($id)
    {
        // Delete Data
        $crmLead = CrmLead::findOrFail($id);
        $crmLead->delete();

        \Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Assign staff to lead.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignStaff(Request $request)
    {
        $lead = CrmLead::findOrFail($request->lead_id);
        $lead->counsellor_id = $request->user_id;
        $lead->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Counsellor assigned successfully'
        ]);
    }

    public function addFollowUp(Request $request)
    {
        $request->validate([
            'lead_id' => 'required',
            'follow_up_date' => 'required|date',
            'follow_up_note' => 'required',
        ]);

        CrmLeadFollowUp::create([
            'lead_id' => $request->lead_id,
            'follow_up_date' => $request->follow_up_date,
            'follow_up_time' => $request->follow_up_time,
            'follow_up_note' => $request->follow_up_note,
            'created_by' => Auth::guard('web')->user()->id,
        ]);

        \Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->back();
    }

    public function followUpList(Request $request)
    {
        $data['title'] = "Follow Up List";
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        $rows = CrmLeadFollowUp::with(['lead.source', 'creator'])->orderBy('id', 'desc');
        
        // Filter for specific lead if provided
        if ($request->has('lead_id')) {
            $rows->where('lead_id', $request->lead_id);
        }

        $data['rows'] = $rows->get();

        return view($this->view.'.follow-up', $data);
    }

    public function import()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['access'] = $this->access;

        return view($this->view.'.import', $data);
    }

    public function importStore(Request $request)
    {
        // Import Logic here
        Toastr::info('Import feature is coming soon', 'Information');
        return redirect()->back();
    }

    public function export()
    {
        $rows = CrmLead::with(['program', 'leadStatus', 'source'])->get();
        
        $filename = "leads_".date('Y-m-d').".csv";
        $handle = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');

        fputcsv($handle, ['Name', 'Email', 'Phone', 'Program', 'Source', 'Status', 'Created At']);

        foreach ($rows as $row) {
            fputcsv($handle, [
                $row->name,
                $row->email,
                $row->phone,
                $row->program->title ?? '',
                $row->source->title ?? '',
                $row->leadStatus->title ?? '',
                $row->created_at->format('Y-m-d')
            ]);
        }

        fclose($handle);
        exit;
    }

    public function followUpDestroy($id)
    {
        $followup = \App\Models\CrmLeadFollowUp::findOrFail($id);
        $followup->delete();

        \Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        return redirect()->back();
    }

    public function followUpUpdate(Request $request, $id)
    {
        $request->validate([
            'follow_up_date' => 'required|date',
            'follow_up_note' => 'required',
        ]);

        $followup = \App\Models\CrmLeadFollowUp::findOrFail($id);
        $followup->update([
            'follow_up_date' => $request->follow_up_date,
            'follow_up_time' => $request->follow_up_time,
            'follow_up_note' => $request->follow_up_note,
        ]);

        \Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect()->back();
    }
}

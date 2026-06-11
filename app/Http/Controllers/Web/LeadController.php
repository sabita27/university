<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CrmLead;
use App\Models\CrmLeadSource;
use App\Models\CrmLeadStatus;
use App\Models\CrmQualification;
use App\Models\Program;

class LeadController extends Controller
{
    /**
     * Display the public lead form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['title'] = "Inquiry Form";
        $data['programs'] = Program::where('status', '1')->orderBy('title', 'asc')->get();
        $data['statuses'] = CrmLeadStatus::where('status', '1')->orderBy('title', 'asc')->get();
        $data['qualifications'] = CrmQualification::where('status', '1')->orderBy('id', 'asc')->get();
        $data['lead_sources'] = CrmLeadSource::where('status', '1')->orderBy('title', 'asc')->get();
        
        return view('web.lead-form', $data);
    }

    /**
     * Store a newly created lead in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'program' => 'nullable',
            'status' => 'nullable',
            'educational_qualification' => 'nullable',
        ]);

        // Find Default Source
        $defaultSource = CrmLeadSource::where('slug', 'google')->first() ?? CrmLeadSource::first();

        // Find Default Status (New Lead)
        $defaultStatus = CrmLeadStatus::where('title', 'New Lead')->first() ?? CrmLeadStatus::where('title', 'NEW LEAD')->first() ?? CrmLeadStatus::first();

        // Insert Data
        try {
            $lead = new CrmLead;
            $lead->name = $request->name;
            $lead->father_name = $request->father_name;
            $lead->email = $request->email;
            $lead->phone = $request->phone;
            $lead->educational_qualification = $request->educational_qualification;
            $lead->board = $request->board;
            $lead->total_mark = $request->total_mark;
            $lead->total_percentage = $request->total_percentage;
            $lead->program_id = $request->program;
            $lead->lead_source_id = $request->lead_source ?? ($defaultSource ? $defaultSource->id : null);
            $lead->lead_status_id = $request->status ?? ($defaultStatus ? $defaultStatus->id : null);
            $lead->description = $request->description;
            $lead->status = '1';
            $lead->save();

            \Toastr::success(__('msg_sent_successfully'), __('msg_success'));

            return redirect()->back()->with('success', __('msg_sent_successfully'));
        }
        catch(\Exception $e){
            \Toastr::error(__('msg_created_error'), __('msg_error'));
            return redirect()->back();
        }
    }
}

@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<style>
    .follow-up-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.08);
        background: #fff;
        margin-top: 10px;
    }
    .table-follow-up {
        width: 100%;
        border-collapse: collapse;
    }
    .table-follow-up thead th {
        background: #b5b5b5;
        color: #333;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.72rem;
        padding: 15px 20px;
        border: none;
        vertical-align: middle;
    }
    .table-follow-up tbody tr {
        border-bottom: 1px solid #eee;
    }
    .table-follow-up td {
        padding: 18px 20px;
        vertical-align: middle;
        font-size: 0.85rem;
        color: #444;
    }
    .lead-name-text {
        color: #04a9f5;
        font-weight: 600;
        text-decoration: none;
    }
    .status-expire {
        background-color: #f44336;
        color: #fff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
        min-width: 70px;
    }
    .status-active {
        background-color: #04a9f5;
        color: #fff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
        min-width: 70px;
    }
    .action-btn {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        border: 1px solid #ced4da;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #e91e63;
        background: #fff;
        transition: all 0.2s;
        margin: 0 auto;
    }
    .action-btn:hover {
        background: #f8f9fa;
        border-color: #04a9f5;
    }
    .dropdown-menu {
        padding: 10px;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        border: 1px solid #eee;
    }
    .dropdown-item {
        border-radius: 8px;
        padding: 10px 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        color: #455a64;
        transition: all 0.2s;
    }
    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #04a9f5;
    }
    .dropdown-item.text-danger {
        color: #f44336;
    }
    .dropdown-item i {
        font-size: 15px;
        width: 20px;
        text-align: center;
    }
    .dropdown-item i.fa-eye, 
    .dropdown-item i.fa-pencil-alt, 
    .dropdown-item i.fa-trash-alt {
        color: #04a9f5;
    }
    .dropdown-item i.fa-user-plus {
        color: #263238 !important;
    }
    .remark-view {
        color: #04a9f5;
        cursor: pointer;
        padding: 5px 8px;
        border: 1px dashed #04a9f5;
        border-radius: 4px;
        display: inline-block;
    }
    .agent-avatar-small {
        width: 28px;
        height: 28px;
        background: #04a9f5;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.75rem;
    }
</style>

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="breadcrumb-custom" style="font-size: 14px; color: #888;">
                        <span style="color: #04a9f5;">Follow-Up List</span> / List
                    </div>
                    <a href="{{ route('admin.crm.lead.enquiry') }}" class="btn btn-outline-primary btn-sm px-3" style="border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-arrow-left me-1"></i> Back to Enquiry
                    </a>
                </div>

                <div class="card follow-up-card">
                    <div class="card-header bg-white border-0 py-4 px-4">
                        <h4 class="mb-0 fw-bold" style="color: #333;">Follow Up List <i class="fas fa-th-large ms-1 small text-muted"></i></h4>
                    </div>
                    <div class="card-block p-0">
                        <div class="table-responsive">
                            <table class="table table-follow-up mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">#</th>
                                        <th>LEAD NAME</th>
                                        <th>NEXT FOLLOWUP DATE</th>
                                        <th class="text-center">REMARK</th>
                                        <th class="text-center">SOURCE</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rows as $key => $row)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a href="#" class="lead-name-text">{{ $row->lead->name ?? 'Unknown' }}</a>
                                            <div class="text-muted" style="font-size: 0.75rem;">{{ $row->lead->email ?? '' }}</div>
                                        </td>
                                        <td>
                                            <i class="far fa-calendar-alt me-1 text-muted"></i>
                                            {{ $row->follow_up_date ? \Carbon\Carbon::parse($row->follow_up_date)->format('Y-m-d') : 'Not Set' }}
                                        </td>
                                        <td class="text-center">
                                            <span class="remark-view" data-bs-toggle="modal" data-bs-target="#remarkModal-{{ $row->id }}" title="View Remark">
                                                <i class="far fa-eye"></i>
                                            </span>

                                            {{-- Remark Modal --}}
                                            <div class="modal fade" id="remarkModal-{{ $row->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content" style="border-radius: 12px; border: none;">
                                                        <div class="modal-header" style="background-color: #04a9f5; color: #fff; border-radius: 12px 12px 0 0;">
                                                            <h5 class="modal-title fw-bold">Remark History</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start p-4">
                                                            <div class="mb-2 text-muted small">Lead: <span class="fw-bold text-dark">{{ $row->lead->name ?? '' }}</span></div>
                                                            <div class="p-3 bg-light rounded" style="font-size: 0.9rem; line-height: 1.6; color: #333;">
                                                                {{ $row->follow_up_note ?? 'No note provided' }}
                                                            </div>
                                                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                                                <div class="text-primary fw-bold small">
                                                                    <i class="far fa-clock me-1"></i> Follow-up: 
                                                                    {{ \Carbon\Carbon::parse($row->follow_up_date)->format('M d, Y') }} 
                                                                    @if($row->follow_up_time)
                                                                        at {{ \Carbon\Carbon::parse($row->follow_up_time)->format('h:i A') }}
                                                                    @endif
                                                                </div>
                                                                <div class="text-muted small" style="font-size: 0.7rem;">
                                                                    Logged by {{ $row->creator->first_name ?? 'System' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <div class="agent-avatar-small" style="background: #04a9f5;">
                                                    {{ strtoupper(substr($row->lead->source->title ?? 'S', 0, 1)) }}
                                                </div>
                                                <span class="fw-600 text-dark" style="font-size: 0.8rem;">{{ $row->lead->source->title ?? 'Direct' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @php 
                                                $fDate = $row->follow_up_date ? \Carbon\Carbon::parse($row->follow_up_date) : null;
                                                $isExpired = $fDate && $fDate->isPast() && !$fDate->isToday();
                                            @endphp
                                            @if($isExpired)
                                                <span class="status-expire">Expire</span>
                                            @else
                                                <span class="status-active">Active</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown dropstart">
                                                <button class="action-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-boundary="viewport">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu border-0 shadow-lg" style="min-width: 180px; border-radius: 12px; padding: 8px;">
                                                    <li>
                                                        <a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#editFollowUpModal-{{ $row->id }}">
                                                            <i class="far fa-edit" style="color: #04a9f5;"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item py-2 text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteFollowUpModal-{{ $row->id }}">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            {{-- Edit Follow Up Modal --}}
                                            <div class="modal fade" id="editFollowUpModal-{{ $row->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content" style="border-radius: 12px; border: none;">
                                                        <div class="modal-header" style="background-color: #04a9f5; color: #fff; border-radius: 12px 12px 0 0;">
                                                            <h5 class="modal-title fw-bold">Edit Follow Up</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('admin.crm.lead.follow-up.update', $row->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body text-start p-4">
                                                                <div class="row g-3">
                                                                    <div class="col-md-6">
                                                                        <label class="form-label small fw-bold">Next Follow Up Date</label>
                                                                        <input type="date" name="follow_up_date" class="form-control" value="{{ $row->follow_up_date }}" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label small fw-bold">Next Follow Up Time</label>
                                                                        <input type="time" name="follow_up_time" class="form-control" value="{{ $row->follow_up_time }}">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="form-label small fw-bold">Remark</label>
                                                                        <textarea name="follow_up_note" class="form-control" rows="4" required>{{ $row->follow_up_note }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0 justify-content-center pb-4">
                                                                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-primary px-4" style="background-color: #04a9f5; border: none;">Update Entry</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Delete Follow Up Modal --}}
                                            <div class="modal fade" id="deleteFollowUpModal-{{ $row->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                                                        <div class="modal-body text-center p-4">
                                                            <i class="fas fa-exclamation-triangle text-danger mb-3" style="font-size: 2.5rem;"></i>
                                                            <h5 class="fw-bold mb-2">Delete Entry?</h5>
                                                            <p class="text-muted small mb-4">Are you sure you want to delete this follow-up entry?</p>
                                                            <form action="{{ route('admin.crm.lead.follow-up.destroy', $row->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="d-flex gap-2">
                                                                    <button type="button" class="btn btn-light w-100" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-danger w-100">Yes, Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-info-circle fa-2x mb-3"></i>
                                                <p>No follow-up history found.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer border-0 bg-white py-4 px-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

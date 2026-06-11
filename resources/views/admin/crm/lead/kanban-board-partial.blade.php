<div class="kb-outer">
<div class="kb-board" id="kanbanBoard">

@php
$palette = ['#8b5cf6','#f59e0b','#14b8a6','#ec4899','#3b82f6','#ef4444','#10b981','#6366f1'];
$prioMap = [
    'high' => 'prio-high',
    'medium' => 'prio-med',
    'low' => 'prio-low'
];

// Determine priority level based on source or string length as a fallback
function getPrioClass($src) {
    $s = strtolower($src);
    if(str_contains($s, 'google') || str_contains($s, 'direct')) return 'prio-high';
    if(str_contains($s, 'facebook') || str_contains($s, 'social')) return 'prio-med';
    if(str_contains($s, 'referral') || str_contains($s, 'other')) return 'prio-low';
    return 'prio-def';
}

function getPrioLabel($src) {
    $s = strtolower($src);
    if(str_contains($s, 'google') || str_contains($s, 'direct')) return 'HIGH';
    if(str_contains($s, 'facebook') || str_contains($s, 'social')) return 'MEDIUM';
    if(str_contains($s, 'referral') || str_contains($s, 'other')) return 'LOW';
    return strtoupper(substr($src, 0, 8));
}
@endphp

@foreach($statuses as $i => $status)
@php
    $leads = $rows->where('lead_status_id', $status->id);
@endphp

<div class="kb-col" data-sid="{{ $status->id }}"
     ondragover="kbAllowDrop(event)"
     ondragleave="kbDragLeave(event)"
     ondrop="kbDrop(event,{{ $status->id }})">

    {{-- Column Header --}}
    <div class="kb-col-head">
        <div class="kb-col-head-title">
            {{ $status->title }}
            <span style="background:#f1f5f9; color:#64748b; font-size:.7rem; padding:2px 6px; border-radius:12px; margin-left:4px;">{{ $leads->count() }}</span>
        </div>
        <div class="dropdown">
            <i class="fas fa-ellipsis-v dots" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:12px;">
                <li><a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#editStatusModal-{{ $status->id }}"><i class="far fa-edit me-2 opacity-50"></i> Edit Column</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item py-2 text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteStatusModal-{{ $status->id }}"><i class="fas fa-trash-alt me-2 opacity-50"></i> Delete Column</a></li>
            </ul>
        </div>
    </div>

    {{-- Edit Status Modal --}}
    <div class="modal fade" id="editStatusModal-{{ $status->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content" style="border-radius:18px;overflow:hidden;border:none;">
        <div class="modal-header" style="background:{{ $status->color ?? '#8b5cf6' }};color:#fff;border:none;">
            <h5 class="modal-title"><i class="far fa-edit me-2"></i>Edit Column: {{ $status->title }}</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.crm.lead-status.update', $status->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="modal-body p-4">
            <div class="mb-3">
                <label class="form-label fw-bold">Column Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" value="{{ $status->title }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Theme Color <span class="text-danger">*</span></label>
                <div class="d-flex gap-2 align-items-center">
                    <input type="color" class="form-control form-control-color" name="color" value="{{ $status->color ?? '#8b5cf6' }}" title="Choose color">
                    <span class="text-muted small">Update the color for this status</span>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Status</label>
                <select class="form-control" name="status">
                    <option value="1" @selected($status->status == 1)>Active</option>
                    <option value="0" @selected($status->status == 0)>Inactive</option>
                </select>
            </div>
            <div class="mb-0">
                <label class="form-label fw-bold">Description</label>
                <textarea class="form-control" name="description" rows="2">{{ $status->description }}</textarea>
            </div>
        </div>
        <div class="modal-footer" style="border:none;padding:14px 24px;">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn" style="background:{{ $status->color ?? '#8b5cf6' }};color:#fff;border:none;border-radius:10px;padding:9px 22px;font-weight:700;">
                Update Column
            </button>
        </div>
        </form>
    </div>
    </div>
    </div>

    {{-- Delete Status Modal --}}
    <div class="modal fade" id="deleteStatusModal-{{ $status->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content" style="border-radius:18px;overflow:hidden;border:none;">
        <div class="modal-header bg-danger text-white border-none">
            <h5 class="modal-title">Delete Column?</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4 text-center">
            <div class="mb-3 text-danger"><i class="fas fa-exclamation-triangle fa-3x"></i></div>
            <p class="mb-0">Are you sure you want to delete the <strong>{{ $status->title }}</strong> column?</p>
            <p class="text-muted small mt-2">All tasks in this column will need to be reassigned.</p>
        </div>
        <div class="modal-footer border-none bg-light p-3">
            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">No, Cancel</button>
            <form action="{{ route('admin.crm.lead-status.destroy', $status->id) }}" method="post" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger rounded-pill px-4">Yes, Delete</button>
            </form>
        </div>
    </div>
    </div>
    </div>

    {{-- Cards --}}
    <div class="kb-col-body" id="col-{{ $status->id }}">
    @forelse($leads as $row)
    @php
        $bg  = $palette[abs(crc32($row->name)) % count($palette)];
        $ini = strtoupper(substr($row->name,0,1));
        $fn  = strtoupper(substr($row->father_name ?? 'X',0,1));
        $src = $row->source?->title ?? 'LEAD';
        $pClass = getPrioClass($src);
        $pLabel = getPrioLabel($src);
        $pVal = match($pClass) { 'prio-high' => 3, 'prio-med' => 2, 'prio-low' => 1, default => 0 };
    @endphp
        @php 
            $prioClass = 'prio-def'; $prioText = 'NEW';
            $pVal = 0;
            $percent = (float)($row->total_percentage ?? 0);
            
            if(($row->source && str_contains(strtolower($row->source->title), 'google')) || $percent >= 80) { 
                $prioClass = 'prio-high'; $prioText = 'HIGH'; $pVal = 3;
            } elseif($percent >= 60) {
                $prioClass = 'prio-med'; $prioText = 'MEDIUM'; $pVal = 2;
            } elseif($percent > 0) {
                $prioClass = 'prio-low'; $prioText = 'LOW'; $pVal = 1;
            }
        @endphp
        <div class="kb-card" id="kc-{{ $row->id }}" draggable="true"
             data-uid="{{ $row->counsellor_id ?? 'unassigned' }}"
             data-date="{{ $row->created_at->format('Y-m-d') }}"
             data-ts="{{ $row->created_at->timestamp }}"
             data-prio="{{ $pVal }}"
             data-name="{{ strtolower($row->name) }}"
             ondragstart="kbDragStart(event,{{ $row->id }})"
             ondragend="kbDragEnd(event)">

        <div class="kb-prio {{ $prioClass }}">{{ $prioText }}</div>

        {{-- Title --}}
        <div class="kb-card-title">{{ $row->name }}</div>

        {{-- Avatars --}}
        <div class="kb-card-avatars">
            @php 
                $staff = $row->staff;
                $bg = '#8b5cf6'; $ini = 'UN';
                if($staff) {
                    $bg = $palette[$staff->id % count($palette)];
                    $ini = strtoupper(substr($staff->first_name, 0, 1));
                }
            @endphp
            <div class="kb-av kb-card-staff-av" style="background:{{ $bg }};" id="staff-av-{{ $row->id }}" title="{{ $staff ? $staff->first_name : 'Unassigned' }}">
                {{ $ini }}
            </div>
            @if($staff)
            <span class="kb-staff-name" id="staff-name-{{ $row->id }}">{{ $staff->first_name }} {{ $staff->last_name }}</span>
            @else
            <span class="kb-staff-name" id="staff-name-{{ $row->id }}" style="display:none;"></span>
            @endif
            
            <div class="dropdown">
                <div class="kb-av plus" data-bs-toggle="dropdown" aria-expanded="false" title="Assign Staff">
                    <i class="fas fa-plus"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:12px; max-height:200px; overflow-y:auto; width:220px;">
                    <li class="dropdown-header text-uppercase small fw-bold">Assign Counselor</li>
                    @foreach($users as $u)
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center justify-content-between" href="#" onclick="assignLeadStaff({{ $row->id }}, {{ $u->id }}, '{{ strtoupper(substr($u->first_name, 0, 1)) }}', '{{ $palette[$u->id % count($palette)] }}', '{{ $u->first_name }}', '{{ $u->first_name }} {{ $u->last_name }}')">
                            <div class="d-flex align-items-center gap-2">
                                <span class="kb-av" style="width:20px; height:20px; font-size:.5rem; background:{{ $palette[$u->id % count($palette)] }}; margin:0;">{{ strtoupper(substr($u->first_name, 0, 1)) }}</span>
                                <span class="small fw-600">{{ $u->first_name }} {{ $u->last_name }}</span>
                            </div>
                            @if($row->counsellor_id == $u->id)
                            <i class="fas fa-check text-success small" id="check-{{ $row->id }}-{{ $u->id }}"></i>
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Subtasks (Details) --}}
        <div class="kb-subtasks">
            <div class="kb-st-head collapsed" onclick="toggleDetails(this)">
                Details 
                <div class="kb-st-actions">
                    <i class="fas fa-filter kb-st-filter-btn" title="Show Checked Only" onclick="toggleStFilter(this)"></i>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
            <div class="kb-st-list">
                @if($row->father_name)
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-user-friends"></i> <span>{{ $row->father_name }}</span></label>
                @endif
                @if($row->email)
                <label class="kb-st-item is-checked"><input type="checkbox" checked onclick="toggleItemCheck(this)"> <i class="fas fa-envelope"></i> <span>{{ Str::limit($row->email, 25) }}</span></label>
                @endif
                @if($row->phone)
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-phone-alt"></i> <span>{{ $row->phone }}</span></label>
                @endif
                @if($row->educational_qualification)
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-certificate"></i> <span>{{ $row->educational_qualification }}</span></label>
                @endif
                @if($row->board)
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-school"></i> <span>{{ $row->board }}</span></label>
                @endif
                @if($row->total_mark || $row->total_percentage)
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-chart-bar"></i> <span>{{ $row->total_mark ?? '0' }} / {{ $row->total_percentage ?? '0' }}%</span></label>
                @endif
                @if($row->program)
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-graduation-cap"></i> <span>{{ $row->program->title }}</span></label>
                @endif
                @if($row->source)
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-bullhorn"></i> <span>Source: {{ $row->source->title }}</span></label>
                @endif
                @php $latestFollowUp = $row->followUps->first(); @endphp
                @if($latestFollowUp?->follow_up_date)
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-calendar-check text-primary"></i> <span class="fw-bold">Next Follow-up: {{ \Carbon\Carbon::parse($latestFollowUp->follow_up_date)->format('M d, Y') }}</span></label>
                @endif
                @if($latestFollowUp?->follow_up_note)
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-sticky-note text-warning"></i> <span>Note: {{ Str::limit($latestFollowUp->follow_up_note, 60) }}</span></label>
                @endif
            </div>
        </div>

        {{-- Footer Stats & Actions --}}
        <div class="kb-card-footer">
            <div class="kb-stats">
                <span class="kb-stat" title="Created At: {{ $row->created_at->format('M d, Y H:i') }}">
                    <i class="far fa-clock"></i> {{ $row->created_at->diffForHumans(null, true, true) }}
                </span>
            </div>
            <div class="kb-actions">
                @can($access.'-edit')
                <button type="button" class="kb-btn kb-btn-edit" data-bs-toggle="modal" data-bs-target="#editModal-{{ $row->id }}" onclick="event.stopPropagation();"><i class="far fa-edit"></i></button>
                @endcan
                @can($access.'-delete')
                <button type="button" class="kb-btn kb-btn-del" data-bs-toggle="modal" data-bs-target="#deleteCardModal-{{ $row->id }}" onclick="event.stopPropagation();"><i class="fas fa-trash-alt"></i></button>
                @endcan
            </div>
        </div>

    </div>
    @empty
    <div class="kb-empty"><i class="fas fa-inbox"></i>No tasks</div>
    @endforelse
    </div>

    {{-- Add Task Button --}}
    @can($access.'-create')
    <button class="kb-add-task" data-bs-toggle="modal" data-bs-target="#createLeadModal" onclick="setCreateStatus({{ $status->id }})">
        <i class="fas fa-plus"></i> ADD TASK
    </button>
    @endcan

</div>
@endforeach

{{-- Add Column Button --}}
<div class="kb-col" style="width: 150px;">
    <button class="kb-add-task" style="justify-content: flex-start; padding: 0 4px;" data-bs-toggle="modal" data-bs-target="#createStatusModal">
        <i class="fas fa-plus"></i> ADD COLUMN
    </button>
</div>

</div>{{-- /kb-board --}}
</div>

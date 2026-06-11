<div class="kb-outer">
<div class="kb-board" id="kanbanBoard">

<?php
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
?>

<?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
    $leads = $rows->where('lead_status_id', $status->id);
?>

<div class="kb-col" data-sid="<?php echo e($status->id); ?>"
     ondragover="kbAllowDrop(event)"
     ondragleave="kbDragLeave(event)"
     ondrop="kbDrop(event,<?php echo e($status->id); ?>)">

    
    <div class="kb-col-head">
        <div class="kb-col-head-title">
            <?php echo e($status->title); ?>

            <span style="background:#f1f5f9; color:#64748b; font-size:.7rem; padding:2px 6px; border-radius:12px; margin-left:4px;"><?php echo e($leads->count()); ?></span>
        </div>
        <div class="dropdown">
            <i class="fas fa-ellipsis-v dots" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:12px;">
                <li><a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#editStatusModal-<?php echo e($status->id); ?>"><i class="far fa-edit me-2 opacity-50"></i> Edit Column</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item py-2 text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteStatusModal-<?php echo e($status->id); ?>"><i class="fas fa-trash-alt me-2 opacity-50"></i> Delete Column</a></li>
            </ul>
        </div>
    </div>

    
    <div class="modal fade" id="editStatusModal-<?php echo e($status->id); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content" style="border-radius:18px;overflow:hidden;border:none;">
        <div class="modal-header" style="background:<?php echo e($status->color ?? '#8b5cf6'); ?>;color:#fff;border:none;">
            <h5 class="modal-title"><i class="far fa-edit me-2"></i>Edit Column: <?php echo e($status->title); ?></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="<?php echo e(route('admin.crm.lead-status.update', $status->id)); ?>" method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="modal-body p-4">
            <div class="mb-3">
                <label class="form-label fw-bold">Column Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" value="<?php echo e($status->title); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Theme Color <span class="text-danger">*</span></label>
                <div class="d-flex gap-2 align-items-center">
                    <input type="color" class="form-control form-control-color" name="color" value="<?php echo e($status->color ?? '#8b5cf6'); ?>" title="Choose color">
                    <span class="text-muted small">Update the color for this status</span>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Status</label>
                <select class="form-control" name="status">
                    <option value="1" <?php if($status->status == 1): echo 'selected'; endif; ?>>Active</option>
                    <option value="0" <?php if($status->status == 0): echo 'selected'; endif; ?>>Inactive</option>
                </select>
            </div>
            <div class="mb-0">
                <label class="form-label fw-bold">Description</label>
                <textarea class="form-control" name="description" rows="2"><?php echo e($status->description); ?></textarea>
            </div>
        </div>
        <div class="modal-footer" style="border:none;padding:14px 24px;">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn" style="background:<?php echo e($status->color ?? '#8b5cf6'); ?>;color:#fff;border:none;border-radius:10px;padding:9px 22px;font-weight:700;">
                Update Column
            </button>
        </div>
        </form>
    </div>
    </div>
    </div>

    
    <div class="modal fade" id="deleteStatusModal-<?php echo e($status->id); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content" style="border-radius:18px;overflow:hidden;border:none;">
        <div class="modal-header bg-danger text-white border-none">
            <h5 class="modal-title">Delete Column?</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4 text-center">
            <div class="mb-3 text-danger"><i class="fas fa-exclamation-triangle fa-3x"></i></div>
            <p class="mb-0">Are you sure you want to delete the <strong><?php echo e($status->title); ?></strong> column?</p>
            <p class="text-muted small mt-2">All tasks in this column will need to be reassigned.</p>
        </div>
        <div class="modal-footer border-none bg-light p-3">
            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">No, Cancel</button>
            <form action="<?php echo e(route('admin.crm.lead-status.destroy', $status->id)); ?>" method="post" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger rounded-pill px-4">Yes, Delete</button>
            </form>
        </div>
    </div>
    </div>
    </div>

    
    <div class="kb-col-body" id="col-<?php echo e($status->id); ?>">
    <?php $__empty_1 = true; $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
        $bg  = $palette[abs(crc32($row->name)) % count($palette)];
        $ini = strtoupper(substr($row->name,0,1));
        $fn  = strtoupper(substr($row->father_name ?? 'X',0,1));
        $src = $row->source?->title ?? 'LEAD';
        $pClass = getPrioClass($src);
        $pLabel = getPrioLabel($src);
        $pVal = match($pClass) { 'prio-high' => 3, 'prio-med' => 2, 'prio-low' => 1, default => 0 };
    ?>
        <?php 
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
        ?>
        <div class="kb-card" id="kc-<?php echo e($row->id); ?>" draggable="true"
             data-uid="<?php echo e($row->counsellor_id ?? 'unassigned'); ?>"
             data-date="<?php echo e($row->created_at->format('Y-m-d')); ?>"
             data-ts="<?php echo e($row->created_at->timestamp); ?>"
             data-prio="<?php echo e($pVal); ?>"
             data-name="<?php echo e(strtolower($row->name)); ?>"
             ondragstart="kbDragStart(event,<?php echo e($row->id); ?>)"
             ondragend="kbDragEnd(event)">

        <div class="kb-prio <?php echo e($prioClass); ?>"><?php echo e($prioText); ?></div>

        
        <div class="kb-card-title"><?php echo e($row->name); ?></div>

        
        <div class="kb-card-avatars">
            <?php 
                $staff = $row->staff;
                $bg = '#8b5cf6'; $ini = 'UN';
                if($staff) {
                    $bg = $palette[$staff->id % count($palette)];
                    $ini = strtoupper(substr($staff->first_name, 0, 1));
                }
            ?>
            <div class="kb-av kb-card-staff-av" style="background:<?php echo e($bg); ?>;" id="staff-av-<?php echo e($row->id); ?>" title="<?php echo e($staff ? $staff->first_name : 'Unassigned'); ?>">
                <?php echo e($ini); ?>

            </div>
            <?php if($staff): ?>
            <span class="kb-staff-name" id="staff-name-<?php echo e($row->id); ?>"><?php echo e($staff->first_name); ?> <?php echo e($staff->last_name); ?></span>
            <?php else: ?>
            <span class="kb-staff-name" id="staff-name-<?php echo e($row->id); ?>" style="display:none;"></span>
            <?php endif; ?>
            
            <div class="dropdown">
                <div class="kb-av plus" data-bs-toggle="dropdown" aria-expanded="false" title="Assign Staff">
                    <i class="fas fa-plus"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:12px; max-height:200px; overflow-y:auto; width:220px;">
                    <li class="dropdown-header text-uppercase small fw-bold">Assign Counselor</li>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center justify-content-between" href="#" onclick="assignLeadStaff(<?php echo e($row->id); ?>, <?php echo e($u->id); ?>, '<?php echo e(strtoupper(substr($u->first_name, 0, 1))); ?>', '<?php echo e($palette[$u->id % count($palette)]); ?>', '<?php echo e($u->first_name); ?>', '<?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?>')">
                            <div class="d-flex align-items-center gap-2">
                                <span class="kb-av" style="width:20px; height:20px; font-size:.5rem; background:<?php echo e($palette[$u->id % count($palette)]); ?>; margin:0;"><?php echo e(strtoupper(substr($u->first_name, 0, 1))); ?></span>
                                <span class="small fw-600"><?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?></span>
                            </div>
                            <?php if($row->counsellor_id == $u->id): ?>
                            <i class="fas fa-check text-success small" id="check-<?php echo e($row->id); ?>-<?php echo e($u->id); ?>"></i>
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>

        
        <div class="kb-subtasks">
            <div class="kb-st-head collapsed" onclick="toggleDetails(this)">
                Details 
                <div class="kb-st-actions">
                    <i class="fas fa-filter kb-st-filter-btn" title="Show Checked Only" onclick="toggleStFilter(this)"></i>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
            <div class="kb-st-list">
                <?php if($row->father_name): ?>
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-user-friends"></i> <span><?php echo e($row->father_name); ?></span></label>
                <?php endif; ?>
                <?php if($row->email): ?>
                <label class="kb-st-item is-checked"><input type="checkbox" checked onclick="toggleItemCheck(this)"> <i class="fas fa-envelope"></i> <span><?php echo e(Str::limit($row->email, 25)); ?></span></label>
                <?php endif; ?>
                <?php if($row->phone): ?>
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-phone-alt"></i> <span><?php echo e($row->phone); ?></span></label>
                <?php endif; ?>
                <?php if($row->educational_qualification): ?>
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-certificate"></i> <span><?php echo e($row->educational_qualification); ?></span></label>
                <?php endif; ?>
                <?php if($row->board): ?>
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-school"></i> <span><?php echo e($row->board); ?></span></label>
                <?php endif; ?>
                <?php if($row->total_mark || $row->total_percentage): ?>
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-chart-bar"></i> <span><?php echo e($row->total_mark ?? '0'); ?> / <?php echo e($row->total_percentage ?? '0'); ?>%</span></label>
                <?php endif; ?>
                <?php if($row->program): ?>
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-graduation-cap"></i> <span><?php echo e($row->program->title); ?></span></label>
                <?php endif; ?>
                <?php if($row->source): ?>
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-bullhorn"></i> <span>Source: <?php echo e($row->source->title); ?></span></label>
                <?php endif; ?>
                <?php $latestFollowUp = $row->followUps->first(); ?>
                <?php if($latestFollowUp?->follow_up_date): ?>
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-calendar-check text-primary"></i> <span class="fw-bold">Next Follow-up: <?php echo e(\Carbon\Carbon::parse($latestFollowUp->follow_up_date)->format('M d, Y')); ?></span></label>
                <?php endif; ?>
                <?php if($latestFollowUp?->follow_up_note): ?>
                <label class="kb-st-item"><input type="checkbox" onclick="toggleItemCheck(this)"> <i class="fas fa-sticky-note text-warning"></i> <span>Note: <?php echo e(Str::limit($latestFollowUp->follow_up_note, 60)); ?></span></label>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="kb-card-footer">
            <div class="kb-stats">
                <span class="kb-stat" title="Created At: <?php echo e($row->created_at->format('M d, Y H:i')); ?>">
                    <i class="far fa-clock"></i> <?php echo e($row->created_at->diffForHumans(null, true, true)); ?>

                </span>
            </div>
            <div class="kb-actions">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-edit')): ?>
                <button type="button" class="kb-btn kb-btn-edit" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo e($row->id); ?>" onclick="event.stopPropagation();"><i class="far fa-edit"></i></button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-delete')): ?>
                <button type="button" class="kb-btn kb-btn-del" data-bs-toggle="modal" data-bs-target="#deleteCardModal-<?php echo e($row->id); ?>" onclick="event.stopPropagation();"><i class="fas fa-trash-alt"></i></button>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="kb-empty"><i class="fas fa-inbox"></i>No tasks</div>
    <?php endif; ?>
    </div>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-create')): ?>
    <button class="kb-add-task" data-bs-toggle="modal" data-bs-target="#createLeadModal" onclick="setCreateStatus(<?php echo e($status->id); ?>)">
        <i class="fas fa-plus"></i> ADD TASK
    </button>
    <?php endif; ?>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<div class="kb-col" style="width: 150px;">
    <button class="kb-add-task" style="justify-content: flex-start; padding: 0 4px;" data-bs-toggle="modal" data-bs-target="#createStatusModal">
        <i class="fas fa-plus"></i> ADD COLUMN
    </button>
</div>

</div>
</div>
<?php /**PATH C:\xampp\htdocs\university\resources\views\admin\crm\lead\kanban-board-partial.blade.php ENDPATH**/ ?>
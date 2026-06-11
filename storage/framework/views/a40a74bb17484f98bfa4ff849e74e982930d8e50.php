<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('page_css'); ?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
*{font-family:'Plus Jakarta Sans',sans-serif;box-sizing:border-box;}

/* PAGE */
.kb-page { padding: 30px; background: #f8f9fc; min-height: 100vh; }

/* HEADER */
.kb-header-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px; }
.kb-proj-title { display: flex; align-items: center; gap: 12px; font-size: 1.5rem; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.kb-proj-title i.main-icon { color: #8b5cf6; font-size: 1.4rem; }
.kb-proj-title i.edit-icon { font-size: 0.9rem; color: #94a3b8; cursor: pointer; margin-left: 4px; transition: color 0.2s; }
.kb-proj-title i.edit-icon:hover { color: #6366f1; }
.kb-top-avatars { display: flex; align-items: center; padding-left: 12px; }
.kb-top-avatars .kb-av { margin-left: -10px; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: .8rem; font-weight: 700; color: #fff; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05); cursor: pointer; transition: transform 0.2s; position: relative; }
.kb-top-avatars .kb-av:hover { transform: translateY(-3px) scale(1.1); z-index: 10; }
.kb-top-avatars .kb-av.plus { background: #f8fafc; color: #64748b; border: 1px dashed #cbd5e1; cursor: pointer; }

/* FILTERS */
.kb-filters { display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px; }
.kb-filter-group { display: flex; align-items: center; gap: 48px; }
.kb-filter-item { display: flex; flex-direction: column; gap: 8px; }
.kb-filter-lbl { font-size: .7rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; }
.kb-filter-val { display: flex; align-items: center; gap: 8px; font-size: .95rem; color: #64748b; font-weight: 500; cursor: pointer; }
.kb-filter-val i { color: #94a3b8; font-size: 1rem; }
.kb-filter-pill { background: #8b5cf6; color: #fff; padding: 6px 16px; border-radius: 24px; font-size: .9rem; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.25); transition: all 0.2s; }
.kb-filter-pill:hover { transform: translateY(-1px); box-shadow: 0 6px 15px rgba(139, 92, 246, 0.3); }
.kb-filter-pill i { font-size: .7rem; color: rgba(255,255,255,0.8); }

/* DROPDOWN BEAK (ARROW) */
.dropdown-menu { border-radius: 16px !important; box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important; margin-top: 10px !important; }
.dropdown-menu::before { content: ""; position: absolute; top: -8px; left: 24px; border-width: 0 8px 8px 8px; border-style: solid; border-color: transparent transparent #fff transparent; }
.dropdown-menu.dropdown-menu-end::before { left: auto; right: 24px; }
.dropdown-item { transition: all 0.2s; }
.dropdown-item:hover { background: #f1f5f9; color: #8b5cf6; }

.kb-activity-btn { display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #8b5cf6, #6366f1); color: #fff; border: none; padding: 10px 20px; border-radius: 10px; font-size: .9rem; font-weight: 700; cursor: pointer; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3); transition: all 0.2s; }
.kb-activity-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4); }

/* BOARD (VERTICAL COLUMNS) */
.kb-outer { overflow-x: auto; padding-bottom: 20px; }
/* Scrollbar styling for a cleaner look */
.kb-outer::-webkit-scrollbar { height: 8px; }
.kb-outer::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
.kb-outer::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
.kb-outer::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

.kb-board { display: inline-flex; gap: 24px; align-items: flex-start; min-height: 600px; padding-bottom: 20px; }

/* COLUMN */
.kb-col { width: 320px; flex-shrink: 0; display: flex; flex-direction: column; gap: 16px; background: #f8fafc; padding: 16px; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: none; }

/* COLUMN HEADER */
.kb-col-head { display: flex; align-items: center; justify-content: space-between; text-transform: uppercase; font-weight: 800; font-size: .85rem; color: #0f172a; padding: 0 4px; letter-spacing: 0.5px; border-bottom: none; }
.kb-col-head .dots { color: #94a3b8; cursor: pointer; font-size: 1rem; transition: color 0.2s; }
.kb-col-head .dots:hover { color: #0f172a; }
.kb-col-head-title { display: flex; align-items: center; gap: 10px; }
.kb-col-head-title span { background:#e2e8f0; color:#475569; font-size:.7rem; padding:4px 8px; border-radius:20px; font-weight: 700; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05); }

/* COLUMN BODY */
.kb-col-body { display: flex; flex-direction: column; gap: 16px; min-height: 100px; overflow-x: visible; padding-bottom: 0; }
.kb-col.drag-over { background: #eff6ff; border-color: #93c5fd; }
.kb-col.drag-over .kb-col-body { background: transparent; }

/* ADD TASK BUTTON */
.kb-add-task { background: #ffffff; border: 2px dashed #cbd5e1; color: #64748b; font-size: .75rem; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; padding: 14px; border-radius: 14px; width: 100%; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px; }
.kb-add-task:hover { background: #04a9f5; border-color: #04a9f5; color: #ffffff; transform: translateY(-2px); box-shadow: 0 8px 16px rgba(4, 169, 245, 0.2); }
.kb-add-task i { font-size: 0.9rem; }

/* CARD */
.kb-card { width: 100%; background: #fff; border-radius: 16px; padding: 22px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.02); border: 1px solid #f1f5f9; cursor: grab; transition: all .3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column; gap: 14px; position: relative; overflow: hidden; text-align: left; }
.kb-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: transparent; transition: background 0.3s; }
.kb-card:hover { box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05), 0 10px 10px -5px rgba(0,0,0,0.02); transform: translateY(-4px); border-color: #e2e8f0; }
.kb-card.dragging { opacity: .7; transform: rotate(3deg) scale(1.05); cursor: grabbing; z-index: 100; box-shadow: 0 25px 30px rgba(0,0,0,0.1); }

/* PRIORITY LABEL */
.kb-prio { font-size: .65rem; font-weight: 800; text-transform: uppercase; padding: 5px 12px; border-radius: 20px; display: inline-block; width: max-content; letter-spacing: 0.8px; }
.prio-high { background: #fee2e2; color: #ef4444; border: 1px solid #fca5a5; }
.prio-med { background: #fef3c7; color: #f59e0b; border: 1px solid #fcd34d; }
.prio-low { background: #e0f2fe; color: #0ea5e9; border: 1px solid #7dd3fc; }
.prio-def { background: #f3e8ff; color: #8b5cf6; border: 1px solid #d8b4fe; }

.kb-card:hover .prio-high { box-shadow: 0 4px 10px rgba(239, 68, 68, 0.15); }
.kb-card:hover .prio-med { box-shadow: 0 4px 10px rgba(245, 158, 11, 0.15); }
.kb-card:hover .prio-low { box-shadow: 0 4px 10px rgba(14, 165, 233, 0.15); }

/* CARD TITLE */
.kb-card-title { font-size: 1.15rem; font-weight: 800; color: #0f172a; line-height: 1.4; margin-top: 6px; margin-bottom: 2px; }

/* AVATARS IN CARD */
.kb-card-avatars { display: flex; align-items: center; gap: 0; margin-top: 4px; }
.kb-card-avatars .kb-av { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: .75rem; font-weight: 700; color: #fff; border: 3px solid #fff; margin-left: -10px; box-shadow: 0 2px 5px rgba(0,0,0,0.08); transition: transform 0.2s; }
.kb-card-avatars .kb-av:hover { transform: translateY(-2px) scale(1.1); z-index: 10; }
.kb-card-avatars .kb-av:first-child { margin-left: 0; }
.kb-card-avatars .kb-av.plus { background: #f8fafc; color: #64748b; border: 1px dashed #cbd5e1; cursor: pointer; font-size: 1rem; box-shadow: none; }
.kb-card-avatars .kb-av.plus:hover { background: #f1f5f9; color: #0f172a; border-color: #94a3b8; }
.kb-staff-name { font-size: .8rem; font-weight: 700; color: #475569; background: #f1f5f9; padding: 6px 12px; border-radius: 20px; margin-left: 10px; transition: all 0.3s; box-shadow: inset 0 1px 2px rgba(0,0,0,0.02); }
.kb-card:hover .kb-staff-name { background: #04a9f5; color: #fff; box-shadow: 0 4px 10px rgba(4, 169, 245, 0.2); }

/* SUBTASKS / DETAILS */
.kb-subtasks { display: flex; flex-direction: column; gap: 12px; border-top: 1px dashed #e2e8f0; padding-top: 18px; margin-top: 8px; }
.kb-st-head { font-size: .8rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none; transition: color 0.2s; }
.kb-st-head:hover { color: #04a9f5; }
.kb-st-head.collapsed i.fa-chevron-down { transform: rotate(-90deg); }
.kb-st-actions i.active { color: #8b5cf6; }
.kb-st-list { display: flex; flex-direction: column; gap: 10px; transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden; opacity: 1; max-height: 800px; }
.kb-st-head.collapsed + .kb-st-list { max-height: 0 !important; padding-top: 0 !important; margin-top: 0 !important; opacity: 0 !important; pointer-events: none; }
.kb-st-list.filtered .kb-st-item:not(.is-checked) { display: none; }
.kb-st-item { display: flex; align-items: center; gap: 12px; font-size: .9rem; color: #475569; font-weight: 500; transition: all 0.2s; padding: 4px 6px; cursor: pointer; border-radius: 8px; }
.kb-st-item:hover { background: #f8fafc; color: #04a9f5; }
.kb-st-item input[type="checkbox"] { width: 18px; height: 18px; border-radius: 5px; border: 2px solid #cbd5e1; accent-color: #04a9f5; cursor: pointer; margin-top: 0; transition: all 0.2s; }
.kb-st-item.is-checked span { color: #04a9f5; font-weight: 700; }
.kb-st-item i { font-size: .9rem; color: #94a3b8; width: 20px; text-align: center; }
.kb-st-item span { flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

/* FOOTER STATS & ACTIONS */
.kb-card-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 12px; }
.kb-stats { display: flex; align-items: center; gap: 16px; }
.kb-stat { display: flex; align-items: center; gap: 8px; font-size: .85rem; color: #94a3b8; font-weight: 700; background: #f8fafc; padding: 6px 12px; border-radius: 20px; }

.kb-actions { display: flex; gap: 8px; opacity: 0; transform: translateX(10px); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.kb-card:hover .kb-actions { opacity: 1; transform: translateX(0); }
.kb-btn { width: 36px; height: 36px; border: none; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: .9rem; cursor: pointer; transition: all 0.2s; }
.kb-btn-edit { background: #eff6ff; color: #3b82f6; }
.kb-btn-edit:hover { background: #3b82f6; color: #fff; transform: scale(1.1) rotate(5deg); box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3); }
.kb-btn-del { background: #fef2f2; color: #ef4444; }
.kb-btn-del:hover { background: #ef4444; color: #fff; transform: scale(1.1) rotate(-5deg); box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); }

/* EMPTY */
.kb-empty { text-align: center; padding: 50px 20px; color: #94a3b8; font-size: .95rem; background: transparent; border-radius: 16px; border: 2px dashed #cbd5e1; font-weight: 600; display: flex; flex-direction: column; align-items: center; gap: 16px; margin-bottom: 12px; transition: all 0.3s; }
.kb-empty:hover { border-color: #94a3b8; color: #64748b; background: #fff; }
.kb-empty i { font-size: 2.5rem; color: #e2e8f0; transition: color 0.3s; }
.kb-empty:hover i { color: #cbd5e1; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="main-body"><div class="page-wrapper"><div class="kb-page">


<div class="kb-header-top">
    <div class="kb-proj-title">
        <i class="fas fa-layer-group main-icon"></i> 
        <span id="board-title-text">Lead Pipeline</span> 
        <i class="fas fa-pen edit-icon" onclick="renameBoardTitle()"></i>
    </div>
    <div class="kb-top-avatars">
        <?php $colors = ['#8b5cf6','#f59e0b','#14b8a6','#ec4899','#3b82f6']; ?>
        <?php $__currentLoopData = $users->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="kb-av kb-top-user-av" 
                 style="background: <?php echo e($colors[$idx % count($colors)]); ?>;" 
                 title="<?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?>"
                 onclick="quickFilterMember('<?php echo e($u->id); ?>', '<?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?>')">
                <?php echo e(strtoupper(substr($u->first_name, 0, 1))); ?><?php echo e(strtoupper(substr($u->last_name, 0, 1))); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="kb-av plus" title="Add Member"><i class="fas fa-plus"></i></div>
    </div>
</div>


<div class="kb-filters">
    <div class="kb-filter-group">
        <div class="kb-filter-item dropdown">
            <span class="kb-filter-lbl">Date Range</span>
            <span class="kb-filter-val" data-bs-toggle="dropdown" id="dateRangeTrigger">
                <i class="far fa-calendar-alt"></i> <span class="txt" data-val="all">All Time</span> <i class="fas fa-chevron-down" style="font-size: .7rem; margin-left:4px;"></i>
            </span>
            <ul class="dropdown-menu border-0">
                <li><a class="dropdown-item py-2 kb-date-filter" href="#" data-range="all">All Time</a></li>
                <li><a class="dropdown-item py-2 kb-date-filter" href="#" data-range="today">Today</a></li>
                <li><a class="dropdown-item py-2 kb-date-filter" href="#" data-range="week">This Week</a></li>
                <li><a class="dropdown-item py-2 kb-date-filter" href="#" data-range="month">This Month</a></li>
            </ul>
        </div>
        <div class="kb-filter-item dropdown">
            <span class="kb-filter-lbl">Members</span>
            <div class="kb-filter-pill" data-bs-toggle="dropdown" id="memberTrigger">
                <span class="txt" data-val="all">All Members</span> <i class="fas fa-chevron-down"></i>
            </div>
            <ul class="dropdown-menu border-0" style="min-width: 220px; max-height: 300px; overflow-y: auto;">
                <li class="px-3 py-2 mb-1 text-muted fw-bold" style="font-size: 0.7rem; text-transform: uppercase;">Assignees</li>
                <li><a class="dropdown-item py-2 kb-member-filter" href="#" data-uid="all"><i class="fas fa-users me-2 opacity-50"></i> All Members</a></li>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="dropdown-item py-2 kb-member-filter" href="#" data-uid="<?php echo e($u->id); ?>"><?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="kb-filter-item">
            <span class="kb-filter-lbl">Sort By</span>
            <div class="dropdown">
                <span class="kb-filter-val" data-bs-toggle="dropdown" id="sortTrigger">
                    <span class="txt" data-val="newest">Newest</span> <i class="fas fa-chevron-down" style="font-size: .7rem; margin-left:4px;"></i>
                </span>
                <ul class="dropdown-menu border-0">
                    <li><a class="dropdown-item py-2 kb-sort-filter" href="#" data-sort="newest">Newest</a></li>
                    <li><a class="dropdown-item py-2 kb-sort-filter" href="#" data-sort="oldest">Oldest</a></li>
                    <li><a class="dropdown-item py-2 kb-sort-filter" href="#" data-sort="priority">Priority</a></li>
                    <li><a class="dropdown-item py-2 kb-sort-filter" href="#" data-sort="alpha">A-Z Name</a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-create')): ?>
    <button class="kb-activity-btn" data-bs-toggle="modal" data-bs-target="#createLeadModal" onclick="setCreateStatus('')">
        <i class="fas fa-plus-circle"></i> Create Task
    </button>
    <?php endif; ?>
</div>


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


<?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-delete')): ?>
    <div class="modal fade" id="deleteCardModal-<?php echo e($row->id); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius:20px;">
            <div class="modal-body text-center p-4">
                <i class="fas fa-exclamation-triangle text-danger mb-3" style="font-size: 2rem;"></i>
                <h5 class="fw-800 mb-2">Delete Lead?</h5>
                <p class="text-muted small mb-4">Permanently delete <strong><?php echo e($row->name); ?></strong>?</p>
                <form action="<?php echo e(route($route.'.destroy', $row->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light w-100 rounded-pill" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger w-100 rounded-pill">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <?php endif; ?>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-edit')): ?>
    <?php echo $__env->make($view.'.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div></div></div>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-create')): ?>
<div class="modal fade" id="createLeadModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content" style="border-radius:18px;overflow:hidden;border:none;">
    <div class="modal-header" style="background:linear-gradient(135deg,#8b5cf6,#6366f1);color:#fff;border:none;">
        <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Create Task</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <form class="needs-validation" novalidate action="<?php echo e(route($route.'.store')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <div class="modal-body p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
                <div class="invalid-feedback">Name is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Father Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="father_name" value="<?php echo e(old('father_name')); ?>" required>
                <div class="invalid-feedback">Father name is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>" required>
                <div class="invalid-feedback">Phone is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>
                <div class="invalid-feedback">Valid email is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Qualification <span class="text-danger">*</span></label>
                <select name="educational_qualification" class="form-control" required>
                    <option value="">Select</option>
                    <?php $__currentLoopData = $qualifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($q->title); ?>" <?php if(old('educational_qualification')==$q->title): echo 'selected'; endif; ?>><?php echo e($q->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback">Qualification is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Board / School <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="board" value="<?php echo e(old('board')); ?>" required>
                <div class="invalid-feedback">Board/School is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Total Mark <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="total_mark" value="<?php echo e(old('total_mark')); ?>" required>
                <div class="invalid-feedback">Total mark is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Total Percentage (%) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control" name="total_percentage" value="<?php echo e(old('total_percentage')); ?>" required>
                <div class="invalid-feedback">Percentage is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Program <span class="text-danger">*</span></label>
                <select class="form-control" name="program_id" required>
                    <option value="">Select</option>
                    <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($p->id); ?>" <?php if(old('program_id')==$p->id): echo 'selected'; endif; ?>><?php echo e($p->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback">Program is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Source <span class="text-danger">*</span></label>
                <select class="form-control" name="lead_source_id" required>
                    <option value="">Select</option>
                    <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($s->id); ?>" <?php if(old('lead_source_id')==$s->id): echo 'selected'; endif; ?>><?php echo e($s->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback">Source is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                <select class="form-control" name="lead_status_id" required>
                    <option value="">Select</option>
                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($st->id); ?>" <?php if(old('lead_status_id')==$st->id): echo 'selected'; endif; ?>><?php echo e($st->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback">Status is required</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Counselor</label>
                <select class="form-control" name="counsellor_id">
                    <option value="">Select</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php if(old('counsellor_id')==$user->id): echo 'selected'; endif; ?>><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Next Follow-up Date</label>
                <input type="date" class="form-control" name="follow_up_date" value="<?php echo e(old('follow_up_date')); ?>">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" rows="3" required><?php echo e(old('description')); ?></textarea>
                <div class="invalid-feedback">Description is required</div>
            </div>
        </div>
    </div>
    <div class="modal-footer" style="border:none;padding:14px 24px;">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn" style="background:linear-gradient(135deg,#8b5cf6,#6366f1);color:#fff;border:none;border-radius:10px;padding:9px 22px;font-weight:700;">
            <i class="fas fa-check me-1"></i>Save Task
        </button>
    </div>
    </form>
</div>
</div>
</div>
<?php endif; ?>


<div class="modal fade" id="createStatusModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content" style="border-radius:18px;overflow:hidden;border:none;">
    <div class="modal-header" style="background:linear-gradient(135deg,#8b5cf6,#6366f1);color:#fff;border:none;">
        <h5 class="modal-title"><i class="fas fa-plus-square me-2"></i>Add New Column</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <form action="<?php echo e(route('admin.crm.lead-status.store')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <div class="modal-body p-4">
        <div class="mb-3">
            <label class="form-label fw-bold">Column Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" placeholder="e.g., Follow Up" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Theme Color <span class="text-danger">*</span></label>
            <div class="d-flex gap-2 align-items-center">
                <input type="color" class="form-control form-control-color" name="color" value="#8b5cf6" title="Choose color">
                <span class="text-muted small">Pick a color for this status pipeline</span>
            </div>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Description</label>
            <textarea class="form-control" name="description" rows="2" placeholder="Optional details..."></textarea>
        </div>
    </div>
    <div class="modal-footer" style="border:none;padding:14px 24px;">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn" style="background:linear-gradient(135deg,#8b5cf6,#6366f1);color:#fff;border:none;border-radius:10px;padding:9px 22px;font-weight:700;">
            Create Column
        </button>
    </div>
    </form>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_js'); ?>
<script>
(function(){
    const URL_TPL="<?php echo e(route('admin.crm.lead.update-status',':id')); ?>";
    const CSRF="<?php echo e(csrf_token()); ?>";
    let dragId=null,dragEl=null,origCol=null;

    window.setCreateStatus = function(statusId) {
        let select = document.querySelector('#createLeadModal select[name="lead_status_id"]');
        if(select) {
            select.value = statusId;
        }
    };

    window.kbDragStart=(e,id)=>{
        dragId=id;
        dragEl=e.currentTarget;
        origCol=dragEl.closest('.kb-col-body');
        e.dataTransfer.effectAllowed='move';
        setTimeout(()=>dragEl.classList.add('dragging'),0);
    };
    window.kbDragEnd=(e)=>{
        e.currentTarget.classList.remove('dragging');
        document.querySelectorAll('.kb-col').forEach(c=>c.classList.remove('drag-over'));
    };
    window.kbAllowDrop=(e)=>{
        e.preventDefault();
        e.currentTarget.closest('.kb-col').classList.add('drag-over');
    };
    window.kbDragLeave=(e)=>{
        let col = e.currentTarget.closest('.kb-col');
        if(col) col.classList.remove('drag-over');
    };
    window.kbDrop=(e,sid)=>{
        e.preventDefault();
        let col = e.currentTarget.closest('.kb-col');
        if(col) col.classList.remove('drag-over');
        if(!dragEl) return;
        const body = col.querySelector('.kb-col-body');
        body.appendChild(dragEl);
        
        fetch(URL_TPL.replace(':id',dragId),{
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
            body:JSON.stringify({status_id:sid===0?null:sid})
        }).then(r=>r.json()).then(d=>{
            if(d.success&&typeof toastr!=='undefined') toastr.success('Status updated!');
            applyFilters(); 
        });
        dragId = dragEl = origCol = null;
    };

    <?php if($errors->any()): ?>
    (new bootstrap.Modal(document.getElementById('createLeadModal'))).show();
    <?php endif; ?>

    document.querySelectorAll('.needs-validation').forEach(f=>{
        f.addEventListener('submit',e=>{
            if(!f.checkValidity()){e.preventDefault();e.stopPropagation();}
            f.classList.add('was-validated');
        },false);
    });

    // FILTER LOGIC
    window.applyFilters = function() {
        const rangeVal = document.querySelector('#dateRangeTrigger .txt').dataset.val || 'all';
        const uidVal = document.querySelector('#memberTrigger .txt').dataset.val || 'all';
        const sortVal = document.querySelector('#sortTrigger .txt').dataset.val || 'newest';

        const now = new Date();
        now.setHours(0, 0, 0, 0);
        
        const cards = document.querySelectorAll('.kb-card');
        
        cards.forEach(card => {
            let show = true;
            // Robust date parsing (YYYY-MM-DD)
            const parts = card.dataset.date.split('-');
            const cDate = new Date(parts[0], parts[1] - 1, parts[2]);
            cDate.setHours(0, 0, 0, 0);
            
            const cUid = card.dataset.uid;

            // Date Filter
            if(rangeVal === 'today') {
                if(cDate.getTime() !== now.getTime()) show = false;
            } else if(rangeVal === 'week') {
                const weekAgo = new Date(now);
                weekAgo.setDate(now.getDate() - 7);
                weekAgo.setHours(0, 0, 0, 0);
                if(cDate.getTime() < weekAgo.getTime()) show = false;
            } else if(rangeVal === 'month') {
                if(cDate.getMonth() !== now.getMonth() || cDate.getFullYear() !== now.getFullYear()) show = false;
            } else if(rangeVal === 'all') {
                show = true;
            }

            // Member Filter
            if(uidVal !== 'all' && String(cUid) !== String(uidVal)) show = false;

            card.style.display = show ? 'flex' : 'none';
        });

        // Sort Logic & Update Column Counts
        document.querySelectorAll('.kb-col').forEach(col => {
            const body = col.querySelector('.kb-col-body');
            if(!body) return;
            
            const colCards = Array.from(body.querySelectorAll('.kb-card'));
            
            // Sort them in the DOM
            colCards.sort((a, b) => {
                if(sortVal === 'newest') return parseInt(b.dataset.ts) - parseInt(a.dataset.ts);
                if(sortVal === 'oldest') return parseInt(a.dataset.ts) - parseInt(b.dataset.ts);
                if(sortVal === 'priority') return parseInt(b.dataset.prio) - parseInt(a.dataset.prio);
                if(sortVal === 'alpha') return a.dataset.name.localeCompare(b.dataset.name);
                return 0;
            });
            colCards.forEach(c => body.appendChild(c));
            
            // Update visible count in header
            const visibleCount = colCards.filter(c => c.style.display !== 'none').length;
            const badge = col.querySelector('.kb-col-head-title span');
            if(badge) badge.innerText = visibleCount;
            
            // Handle empty state visibility
            let emptyMsg = body.querySelector('.kb-empty');
            if(visibleCount === 0) {
                if(!emptyMsg) {
                    emptyMsg = document.createElement('div');
                    emptyMsg.className = 'kb-empty';
                    emptyMsg.innerHTML = '<i class="fas fa-inbox"></i>No tasks';
                    body.appendChild(emptyMsg);
                }
                emptyMsg.style.display = 'flex';
            } else if(emptyMsg) {
                emptyMsg.style.display = 'none';
            }
        });
    }

    document.querySelectorAll('.kb-date-filter').forEach(el => {
        el.addEventListener('click', e => {
            e.preventDefault();
            const txt = document.querySelector('#dateRangeTrigger .txt');
            txt.innerText = el.innerText;
            txt.dataset.val = el.dataset.range;
            applyFilters();
        });
    });

    document.querySelectorAll('.kb-member-filter').forEach(el => {
        el.addEventListener('click', e => {
            e.preventDefault();
            const txt = document.querySelector('#memberTrigger .txt');
            txt.innerText = el.textContent.trim();
            txt.dataset.val = el.dataset.uid;
            applyFilters();
        });
    });

    document.querySelectorAll('.kb-sort-filter').forEach(el => {
        el.addEventListener('click', e => {
            e.preventDefault();
            const txt = document.querySelector('#sortTrigger .txt');
            txt.innerText = el.innerText;
            txt.dataset.val = el.dataset.sort;
            applyFilters();
        });
    });

    window.quickFilterMember = function(uid, name) {
        const txt = document.querySelector('#memberTrigger .txt');
        txt.innerText = name;
        txt.dataset.val = uid;
        applyFilters();
        
        // Visual feedback on the avatar
        document.querySelectorAll('.kb-top-user-av').forEach(av => {
            av.style.border = (av.getAttribute('onclick').includes(uid)) ? '2px solid #8b5cf6' : '2px solid #fff';
            av.style.boxShadow = (av.getAttribute('onclick').includes(uid)) ? '0 0 10px rgba(139, 92, 246, 0.5)' : '0 2px 4px rgba(0,0,0,0.05)';
        });
    };

    window.toggleDetails = function(el) {
        if(!el.classList.contains('kb-st-head')) el = el.closest('.kb-st-head');
        el.classList.toggle('collapsed');
    };

    window.toggleStFilter = function(btn) {
        btn.classList.toggle('active');
        const list = btn.closest('.kb-subtasks').querySelector('.kb-st-list');
        list.classList.toggle('filtered');
    };

    window.toggleItemCheck = function(input) {
        event.stopPropagation();
        const item = input.closest('.kb-st-item');
        if(input.checked) item.classList.add('is-checked');
        else item.classList.remove('is-checked');
    };

    window.assignLeadStaff = function(leadId, userId, initial, color, fname, fullName) {
        event.preventDefault();
        fetch("<?php echo e(route('admin.crm.lead.assign-staff')); ?>", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ lead_id: leadId, user_id: userId })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                const av = document.getElementById('staff-av-' + leadId);
                av.innerText = initial;
                av.style.background = color;
                av.title = fname;
                
                const nameLabel = document.getElementById('staff-name-' + leadId);
                nameLabel.innerText = fullName;
                nameLabel.style.display = 'inline-block';
                
                // Update data attribute for filtering
                const card = document.getElementById('kc-' + leadId);
                card.dataset.uid = userId;
                
                // Remove other checks and add new one (simple UI refresh recommended for full consistency)
                Toastr.success('Staff assigned successfully');
                applyFilters(); 
            }
        });
    };

    window.renameBoardTitle = function() {
        const titleSpan = document.getElementById('board-title-text');
        const oldTitle = titleSpan.innerText;
        const newTitle = prompt('Enter new board title:', oldTitle);
        if (newTitle && newTitle.trim() !== "") {
            titleSpan.innerText = newTitle;
            localStorage.setItem('kb_board_title', newTitle);
        }
    };

    window.setCreateStatus = function(sid) {
        document.querySelector('#createLeadModal select[name="lead_status_id"]').value = sid;
    };

    // Load saved title
    const savedTitle = localStorage.getItem('kb_board_title');
    if (savedTitle) {
        const titleSpan = document.getElementById('board-title-text');
        if (titleSpan) titleSpan.innerText = savedTitle;
    }

    // Initial Apply
    applyFilters();
})();
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\crm\lead\index.blade.php ENDPATH**/ ?>
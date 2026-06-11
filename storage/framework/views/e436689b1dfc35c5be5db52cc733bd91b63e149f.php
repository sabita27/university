<div class="kanban-card"
     id="kanban-card-<?php echo e($row->id); ?>"
     draggable="true"
     style="border-left-color:<?php echo e($color); ?>;"
     ondragstart="kanbanDragStart(event, <?php echo e($row->id); ?>)"
     ondragend="kanbanDragEnd(event)">

    
    <div class="card-lead-top">
        <div class="lead-avatar" style="background:<?php echo e($color); ?>22;color:<?php echo e($color); ?>;">
            <?php echo e(strtoupper(substr($row->name, 0, 1))); ?>

        </div>
        <div class="overflow-hidden">
            <div class="lead-name text-truncate"><?php echo e($row->name); ?></div>
            <?php if($row->email): ?>
            <div class="lead-email text-truncate"><?php echo e($row->email); ?></div>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if($row->phone): ?>
    <div class="card-detail-row">
        <i class="fas fa-phone-alt"></i>
        <span><?php echo e($row->phone); ?></span>
    </div>
    <?php endif; ?>

    
    <div>
        <?php if($row->program): ?>
        <span class="card-badge badge-program">
            <i class="fas fa-graduation-cap" style="font-size:.62rem;"></i>
            <?php echo e(Str::limit($row->program->title, 22)); ?>

        </span>
        <?php endif; ?>
        <?php if($row->educational_qualification): ?>
        <span class="card-badge badge-qual"><?php echo e($row->educational_qualification); ?></span>
        <?php endif; ?>
        <?php if($row->source): ?>
        <span class="card-badge badge-source"><?php echo e($row->source->title); ?></span>
        <?php endif; ?>
    </div>

    
    <div class="card-footer-row">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-edit')): ?>
        <button type="button" class="btn-card-action btn-card-edit"
                data-bs-toggle="modal"
                data-bs-target="#editModal-<?php echo e($row->id); ?>"
                title="<?php echo e(__('btn_edit')); ?>">
            <i class="far fa-edit"></i>
        </button>
        <?php echo $__env->make($view.'.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-delete')): ?>
        <button type="button" class="btn-card-action btn-card-del"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal-<?php echo e($row->id); ?>"
                title="<?php echo e(__('btn_delete')); ?>">
            <i class="fas fa-trash-alt"></i>
        </button>
        <?php echo $__env->make('admin.layouts.inc.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\university\resources\views\admin\crm\lead\kanban-card.blade.php ENDPATH**/ ?>
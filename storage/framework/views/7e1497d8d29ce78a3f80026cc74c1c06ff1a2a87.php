<!-- Edit modal -->
<div class="modal fade" id="editModal-<?php echo e($row->id); ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?php echo e($row->id); ?>" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#8b5cf6,#6366f1);color:#fff;border:none;">
                <h5 class="modal-title" id="editModalLabel-<?php echo e($row->id); ?>">
                    <i class="far fa-edit me-2"></i><?php echo e(__('modal_edit')); ?> <?php echo e($title); ?> &nbsp;&mdash;&nbsp; <span style="font-weight:400;font-size:.9em;"><?php echo e($row->name); ?></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0" style="min-height:400px;">

                    
                    <div class="col-md-7 p-4" style="border-right:1px solid #f1f5f9;">
                        <form class="needs-validation" novalidate action="<?php echo e(route($route.'.update', $row->id)); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row g-2">
                                <div class="col-12">
                                    <label class="form-label fw-bold"><?php echo e(__('field_first_name')); ?> <?php echo e(__('field_last_name')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="<?php echo e($row->name); ?>" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><?php echo e(__('field_father_name')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="father_name" value="<?php echo e($row->father_name); ?>" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><?php echo e(__('field_phone')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo e($row->phone); ?>" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold"><?php echo e(__('field_email')); ?> <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="<?php echo e($row->email); ?>" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><?php echo e(__('field_educational_qualification')); ?> <span class="text-danger">*</span></label>
                                    <select name="educational_qualification" class="form-control" required>
                                        <option value=""><?php echo e(__('select')); ?></option>
                                        <?php $__currentLoopData = $qualifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($qualification->title); ?>" <?php if($row->educational_qualification == $qualification->title): ?> selected <?php endif; ?>><?php echo e($qualification->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Board / School <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="board" value="<?php echo e($row->board); ?>" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Total Mark <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_mark" value="<?php echo e($row->total_mark); ?>" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Total Percentage (%) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" name="total_percentage" value="<?php echo e($row->total_percentage); ?>" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><?php echo e(__('field_program')); ?> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="program_id" required>
                                        <option value=""><?php echo e(__('select')); ?></option>
                                        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($program->id); ?>" <?php if($row->program_id == $program->id): ?> selected <?php endif; ?>><?php echo e($program->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><?php echo e(__('field_source')); ?> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="lead_source_id" required>
                                        <option value=""><?php echo e(__('select')); ?></option>
                                        <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($source->id); ?>" <?php if($row->lead_source_id == $source->id): ?> selected <?php endif; ?>><?php echo e($source->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><?php echo e(__('field_status')); ?> <span class="text-danger">*</span></label>
                                    <select class="form-control edit-status-select-<?php echo e($row->id); ?>" name="lead_status_id" required>
                                        <option value=""><?php echo e(__('select')); ?></option>
                                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status->id); ?>" <?php if($row->lead_status_id == $status->id): ?> selected <?php endif; ?>><?php echo e($status->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Counselor</label>
                                    <select class="form-control" name="counsellor_id">
                                        <option value=""><?php echo e(__('select')); ?></option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>" <?php if($row->counsellor_id == $user->id): ?> selected <?php endif; ?>><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Next Follow-up Date</label>
                                    <input type="date" class="form-control" name="follow_up_date" value="<?php echo e($row->followUps->first()?->follow_up_date ?? ''); ?>">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold"><?php echo e(__('field_description')); ?> <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" rows="2" required><?php echo e($row->description); ?></textarea>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                            </div>

                            
                            <div class="follow-up-fields-<?php echo e($row->id); ?> mt-3" style="<?php echo e($row->lead_status_id == 2 ? '' : 'display:none;'); ?>">
                                <div class="p-3 rounded-3" style="background:#f5f3ff;border:1px solid #e0d9ff;">
                                    <h6 class="fw-bold mb-2" style="color:#7c3aed;"><i class="fas fa-calendar-check me-1"></i> Add Follow-up Entry</h6>
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <label class="form-label fw-bold small">Today's Note <span class="text-muted fw-normal">(saved to history)</span></label>
                                            <textarea class="form-control" name="follow_up_note" rows="2" placeholder="Write what happened today..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i><?php echo e(__('btn_close')); ?></button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check me-1"></i><?php echo e(__('btn_update')); ?></button>
                            </div>
                        </form>
                    </div>

                    
                    <div class="col-md-5 p-4" style="background:#fafafa;">
                        <h6 class="fw-bold mb-3" style="color:#374151;"><i class="fas fa-history me-2 text-purple" style="color:#8b5cf6;"></i>Follow-up History</h6>

                        <?php if($row->followUps->isEmpty()): ?>
                            <div class="text-center py-5">
                                <i class="fas fa-clipboard-list" style="font-size:2rem;color:#d1d5db;"></i>
                                <p class="text-muted small mt-2">No follow-ups recorded yet.<br>Change status to "Follow-up Required" and save a note.</p>
                            </div>
                        <?php else: ?>
                            <div class="follow-up-timeline" style="max-height:480px;overflow-y:auto;padding-right:4px;">
                                <?php $__currentLoopData = $row->followUps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="timeline-item d-flex gap-3 mb-3">
                                    <div class="timeline-dot-wrap d-flex flex-column align-items-center" style="min-width:18px;">
                                        <div style="width:12px;height:12px;border-radius:50%;background:#8b5cf6;margin-top:4px;flex-shrink:0;"></div>
                                        <?php if(!$loop->last): ?>
                                        <div style="width:2px;flex:1;background:#e9d5ff;margin-top:4px;"></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="timeline-content p-2 rounded-3 w-100" style="background:#fff;border:1px solid #ede9fe;">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <span class="small fw-bold" style="color:#7c3aed;">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                <?php echo e($fu->follow_up_date ? \Carbon\Carbon::parse($fu->follow_up_date)->format('M d, Y') : '—'); ?>

                                            </span>
                                            <span class="text-muted" style="font-size:.7rem;"><?php echo e($fu->created_at->diffForHumans()); ?></span>
                                        </div>
                                        <?php if($fu->follow_up_note): ?>
                                        <p class="mb-1 mt-1 small text-dark"><?php echo e($fu->follow_up_note); ?></p>
                                        <?php endif; ?>
                                        <?php if($fu->creator): ?>
                                        <span class="small text-muted"><i class="fas fa-user me-1"></i><?php echo e($fu->creator->first_name); ?> <?php echo e($fu->creator->last_name); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('.edit-status-select-<?php echo e($row->id); ?>').addEventListener('change', function() {
        const fields = document.querySelector('.follow-up-fields-<?php echo e($row->id); ?>');
        fields.style.display = this.value == '2' ? 'block' : 'none';
    });
</script>
<?php /**PATH C:\xampp\htdocs\university\resources\views\admin\crm\lead\edit.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="main-body">
    <div class="page-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Assignment</h5>
                    </div>
                    <form class="needs-validation" novalidate action="<?php echo e(route('admin.asset-assignment.update', $row->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="card-block">
                        <div class="form-group">
                            <label class="form-label">Asset <span>*</span></label>
                            <select class="form-control" name="asset_id" required>
                                <option value="">-- Select Asset --</option>
                                <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($asset->id); ?>" <?php echo e($row->asset_id == $asset->id ? 'selected' : ''); ?>>
                                    <?php echo e($asset->name); ?> <?php echo e($asset->serial_number ? '('.$asset->serial_number.')' : ''); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Assign To (User) <span>*</span></label>
                            <select class="form-control" name="user_id" required>
                                <option value="">-- Select User --</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php echo e($row->user_id == $user->id ? 'selected' : ''); ?>>
                                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Assigned Date <span>*</span></label>
                                    <input type="date" class="form-control" name="assigned_date" value="<?php echo e($row->assigned_date->format('Y-m-d')); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Return Date</label>
                                    <input type="date" class="form-control" name="return_date" value="<?php echo e($row->return_date ? $row->return_date->format('Y-m-d') : ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Is Damaged?</label>
                                    <select class="form-control" name="is_damaged">
                                        <option value="0" <?php echo e($row->is_damaged == 0 ? 'selected' : ''); ?>>No</option>
                                        <option value="1" <?php echo e($row->is_damaged == 1 ? 'selected' : ''); ?>>Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Is Returned?</label>
                                    <select class="form-control" name="is_returned">
                                        <option value="0" <?php echo e($row->is_returned == 0 ? 'selected' : ''); ?>>No</option>
                                        <option value="1" <?php echo e($row->is_returned == 1 ? 'selected' : ''); ?>>Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Note</label>
                            <textarea class="form-control" name="note" rows="3"><?php echo e($row->note); ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo e(route('admin.asset-assignment.index')); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\asset\assignment\edit.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="main-body">
    <div class="page-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Assign Asset to User</h5>
                    </div>
                    <form class="needs-validation" novalidate action="<?php echo e(route('admin.asset-assignment.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="card-block">
                        <div class="form-group">
                            <label class="form-label">Asset <span>*</span></label>
                            <select class="form-control" name="asset_id" required>
                                <option value="">-- Select Asset --</option>
                                <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($asset->id); ?>" <?php echo e(old('asset_id') == $asset->id ? 'selected' : ''); ?>>
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
                                <option value="<?php echo e($user->id); ?>" <?php echo e(old('user_id') == $user->id ? 'selected' : ''); ?>>
                                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Assigned Date <span>*</span></label>
                                    <input type="date" class="form-control" name="assigned_date" value="<?php echo e(old('assigned_date', date('Y-m-d'))); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Expected Return Date</label>
                                    <input type="date" class="form-control" name="return_date" value="<?php echo e(old('return_date')); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Note</label>
                            <textarea class="form-control" name="note" rows="3" placeholder="Optional note..."><?php echo e(old('note')); ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo e(route('admin.asset-assignment.index')); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Assign Asset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\asset\assignment\create.blade.php ENDPATH**/ ?>
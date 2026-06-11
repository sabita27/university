<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="main-body">
    <div class="page-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Asset Details — <?php echo e($row->name); ?></h5>
                        <a href="<?php echo e(route('admin.asset.index')); ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr><th width="40%">Asset Name</th><td><?php echo e($row->name); ?></td></tr>
                                    <tr><th>Type</th><td><?php echo e($row->assetType->title ?? '—'); ?></td></tr>
                                    <tr><th>Brand</th><td><?php echo e($row->assetBrand->title ?? '—'); ?></td></tr>
                                    <tr><th>Serial No.</th><td><?php echo e($row->serial_number ?? '—'); ?></td></tr>
                                    <tr><th>Purchased Date</th><td><?php echo e($row->purchased_date ? $row->purchased_date->format('d M, Y') : '—'); ?></td></tr>
                                    <tr><th>Purchased Cost</th><td><?php echo e($row->purchased_cost ? number_format($row->purchased_cost, 2) : '—'); ?></td></tr>
                                    <tr>
                                        <th>Working Status</th>
                                        <td>
                                            <span class="badge badge-pill <?php echo e($row->working_status == 1 ? 'badge-success' : 'badge-danger'); ?>">
                                                <?php echo e($row->working_status == 1 ? 'Working' : 'Not Working'); ?>

                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Availability</th>
                                        <td>
                                            <span class="badge badge-pill <?php echo e($row->availability_status == 1 ? 'badge-success' : 'badge-danger'); ?>">
                                                <?php echo e($row->availability_status == 1 ? 'Available' : 'Not Available'); ?>

                                            </span>
                                        </td>
                                    </tr>
                                    <tr><th>Description</th><td><?php echo e($row->description ?? '—'); ?></td></tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Assignment History</h6>
                                <?php $__empty_1 = true; $__currentLoopData = $row->assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="card border-left-primary mb-2" style="border-left: 3px solid #2563eb;">
                                    <div class="card-block p-3">
                                        <strong><?php echo e($assignment->user->first_name ?? ''); ?> <?php echo e($assignment->user->last_name ?? ''); ?></strong><br>
                                        <small>Assigned: <?php echo e($assignment->assigned_date->format('d M, Y')); ?></small><br>
                                        <?php if($assignment->return_date): ?>
                                        <small>Return: <?php echo e($assignment->return_date->format('d M, Y')); ?></small><br>
                                        <?php endif; ?>
                                        <span class="badge badge-pill <?php echo e($assignment->is_returned ? 'badge-success' : 'badge-warning'); ?>">
                                            <?php echo e($assignment->is_returned ? 'Returned' : 'Active'); ?>

                                        </span>
                                        <?php if($assignment->is_damaged): ?>
                                        <span class="badge badge-pill badge-danger">Damaged</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-muted">No assignment history.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\asset\asset\show.blade.php ENDPATH**/ ?>
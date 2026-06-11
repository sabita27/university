<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="main-body">
    <div class="page-wrapper">
        <!-- Header -->
        <div class="row align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0"><?php echo e($title); ?></h5>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('admin.asset-assignment.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Assign to User
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-block">
                <form method="GET" action="<?php echo e(route('admin.asset-assignment.index')); ?>">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">User Name</label>
                                <select class="form-control" name="user_id">
                                    <option value="">All Users</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php echo e(request('user_id') == $user->id ? 'selected' : ''); ?>>
                                        <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Asset Type</label>
                                <select class="form-control" name="type">
                                    <option value="">All Types</option>
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->id); ?>" <?php echo e(request('type') == $type->id ? 'selected' : ''); ?>><?php echo e($type->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Damaged</label>
                                <select class="form-control" name="is_damaged">
                                    <option value="">All</option>
                                    <option value="1" <?php echo e(request('is_damaged') === '1' ? 'selected' : ''); ?>>Yes</option>
                                    <option value="0" <?php echo e(request('is_damaged') === '0' ? 'selected' : ''); ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Returned</label>
                                <select class="form-control" name="is_returned">
                                    <option value="">All</option>
                                    <option value="1" <?php echo e(request('is_returned') === '1' ? 'selected' : ''); ?>>Yes</option>
                                    <option value="0" <?php echo e(request('is_returned') === '0' ? 'selected' : ''); ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Assigned Date</label>
                                <input type="date" class="form-control" name="assigned_date" value="<?php echo e(request('assigned_date')); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Return Date</label>
                                <input type="date" class="form-control" name="return_date" value="<?php echo e(request('return_date')); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Search</button>
                            <a href="<?php echo e(route('admin.asset-assignment.index')); ?>" class="btn btn-secondary btn-sm"><i class="fas fa-sync-alt"></i> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-block">
                <div class="table-responsive">
                    <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asset Name</th>
                                <th>Asset Type</th>
                                <th>Assigned To</th>
                                <th>Assigned Date</th>
                                <th>Return Date</th>
                                <th>Damaged</th>
                                <th>Returned</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key + 1); ?></td>
                                <td><?php echo e($row->asset->name ?? '—'); ?></td>
                                <td><?php echo e($row->asset->assetType->title ?? '—'); ?></td>
                                <td><?php echo e($row->user->first_name ?? ''); ?> <?php echo e($row->user->last_name ?? ''); ?></td>
                                <td><?php echo e($row->assigned_date->format('d M, Y')); ?></td>
                                <td><?php echo e($row->return_date ? $row->return_date->format('d M, Y') : '—'); ?></td>
                                <td>
                                    <span class="badge badge-pill <?php echo e($row->is_damaged ? 'badge-danger' : 'badge-secondary'); ?>">
                                        <?php echo e($row->is_damaged ? 'Yes' : 'No'); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-pill <?php echo e($row->is_returned ? 'badge-success' : 'badge-warning'); ?>">
                                        <?php echo e($row->is_returned ? 'Yes' : 'No'); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?php echo e(route('admin.asset-assignment.edit', $row->id)); ?>">
                                                <i class="far fa-edit"></i> Edit
                                            </a>
                                            <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-<?php echo e($row->id); ?>">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                    <?php echo $__env->make('admin.layouts.inc.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\asset\assignment\index.blade.php ENDPATH**/ ?>
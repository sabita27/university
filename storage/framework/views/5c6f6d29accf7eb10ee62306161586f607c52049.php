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
                <a href="<?php echo e(route('admin.asset.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Asset
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-block">
                <form method="GET" action="<?php echo e(route('admin.asset.index')); ?>">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Asset Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo e(request('name')); ?>" placeholder="Search name...">
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
                                <label class="form-label">Working Status</label>
                                <select class="form-control" name="working_status">
                                    <option value="">All</option>
                                    <option value="1" <?php echo e(request('working_status') === '1' ? 'selected' : ''); ?>>Working</option>
                                    <option value="0" <?php echo e(request('working_status') === '0' ? 'selected' : ''); ?>>Not Working</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Availability</label>
                                <select class="form-control" name="availability_status">
                                    <option value="">All</option>
                                    <option value="1" <?php echo e(request('availability_status') === '1' ? 'selected' : ''); ?>>Available</option>
                                    <option value="0" <?php echo e(request('availability_status') === '0' ? 'selected' : ''); ?>>Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Purchased From</label>
                                <input type="date" class="form-control" name="date_from" value="<?php echo e(request('date_from')); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Purchased To</label>
                                <input type="date" class="form-control" name="date_to" value="<?php echo e(request('date_to')); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Search</button>
                            <a href="<?php echo e(route('admin.asset.index')); ?>" class="btn btn-secondary btn-sm"><i class="fas fa-sync-alt"></i> Reset</a>
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
                                <th>Type</th>
                                <th>Brand</th>
                                <th>Serial No.</th>
                                <th>Purchased Date</th>
                                <th>Working</th>
                                <th>Available</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key + 1); ?></td>
                                <td><?php echo e($row->name); ?></td>
                                <td><?php echo e($row->assetType->title ?? '—'); ?></td>
                                <td><?php echo e($row->assetBrand->title ?? '—'); ?></td>
                                <td><?php echo e($row->serial_number ?? '—'); ?></td>
                                <td><?php echo e($row->purchased_date ? $row->purchased_date->format('d M, Y') : '—'); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.asset.working-status', $row->id)); ?>" class="badge badge-pill <?php echo e($row->working_status == 1 ? 'badge-success' : 'badge-danger'); ?>">
                                        <?php echo e($row->working_status == 1 ? 'Working' : 'Not Working'); ?>

                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.asset.availability-status', $row->id)); ?>" class="badge badge-pill <?php echo e($row->availability_status == 1 ? 'badge-success' : 'badge-danger'); ?>">
                                        <?php echo e($row->availability_status == 1 ? 'Available' : 'Not Available'); ?>

                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.asset.show', $row->id)); ?>" class="btn btn-icon btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="<?php echo e(route('admin.asset.edit', $row->id)); ?>" class="btn btn-icon btn-primary btn-sm"><i class="far fa-edit"></i></a>
                                    <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-<?php echo e($row->id); ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\asset\asset\index.blade.php ENDPATH**/ ?>
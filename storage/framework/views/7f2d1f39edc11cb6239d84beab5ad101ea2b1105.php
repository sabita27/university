<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="main-body">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Asset</h5>
                    </div>
                    <form class="needs-validation" novalidate action="<?php echo e(route('admin.asset.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="card-block">
                        <div class="form-group">
                            <label class="form-label">Asset Name <span>*</span></label>
                            <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter asset name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Asset Type</label>
                                    <select class="form-control" name="asset_type_id">
                                        <option value="">-- Select Type --</option>
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>" <?php echo e(old('asset_type_id') == $type->id ? 'selected' : ''); ?>><?php echo e($type->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Asset Brand</label>
                                    <select class="form-control" name="asset_brand_id">
                                        <option value="">-- Select Brand --</option>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($brand->id); ?>" <?php echo e(old('asset_brand_id') == $brand->id ? 'selected' : ''); ?>><?php echo e($brand->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Serial Number</label>
                                    <input type="text" class="form-control" name="serial_number" value="<?php echo e(old('serial_number')); ?>" placeholder="Serial number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Purchased Date</label>
                                    <input type="date" class="form-control" name="purchased_date" value="<?php echo e(old('purchased_date')); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Purchased Cost</label>
                            <input type="number" step="0.01" class="form-control" name="purchased_cost" value="<?php echo e(old('purchased_cost')); ?>" placeholder="0.00">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Optional description..."><?php echo e(old('description')); ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo e(route('admin.asset.index')); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Save Asset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\asset\asset\create.blade.php ENDPATH**/ ?>
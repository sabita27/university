<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e($title); ?> <?php echo e(__('import')); ?></h5>
                    </div>
                    <div class="card-block">
                        <a href="<?php echo e(route($route.'.index')); ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> <?php echo e(__('btn_back')); ?></a>

                        <a href="<?php echo e(asset('dashboard/sample/leads.xlsx')); ?>" class="btn btn-info" download><i class="fas fa-download"></i> <?php echo e(__('download_sample')); ?></a>

                        <hr/>

                        <form class="needs-validation" novalidate action="<?php echo e(route($route.'.import.store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="import"><?php echo e(__('upload_excel')); ?> <span>*</span></label>
                                    <input type="file" class="form-control" name="import" id="import" accept=".xlsx, .xls, .csv" required>
                                    <div class="invalid-feedback">
                                      <?php echo e(__('field_required')); ?>

                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-success" style="margin-top: 30px;"><i class="fas fa-upload"></i> <?php echo e(__('btn_upload')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\crm\lead\import.blade.php ENDPATH**/ ?>
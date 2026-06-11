    <!-- Add modal content -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form class="needs-validation" novalidate action="<?php echo e(route($route.'.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"><?php echo e(__('btn_issue')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <!-- Form Start -->
                    <?php echo $__env->make('common.inc.inventory_search_filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="form-group col-md-6">
                        <label for="issue_date"><?php echo e(__('field_issue_date')); ?> <span>*</span></label>
                        <input type="date" class="form-control date" name="issue_date" id="issue_date" value="<?php echo e(date('Y-m-d')); ?>" required>

                        <div class="invalid-feedback">
                          <?php echo e(__('required_field')); ?> <?php echo e(__('field_issue_date')); ?>

                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="due_date"><?php echo e(__('field_due_return_date')); ?> <span>*</span></label>
                        <input type="date" class="form-control date" name="due_date" id="due_date" value="<?php echo e(date('Y-m-d')); ?>" required>

                        <div class="invalid-feedback">
                          <?php echo e(__('required_field')); ?> <?php echo e(__('field_due_return_date')); ?>

                        </div>
                    </div>
                    <!-- Form End -->
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> <?php echo e(__('btn_close')); ?></button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> <?php echo e(__('btn_issue')); ?></button>
                </div>

              </form>
            </div>
        </div>
    </div><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\item-issue\create.blade.php ENDPATH**/ ?>
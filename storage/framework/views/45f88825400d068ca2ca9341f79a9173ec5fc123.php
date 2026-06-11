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
                    <div class="form-group col-md-6">
                        <label for="book"><?php echo e(__('field_book')); ?> <span>*</span></label>
                        <select class="form-control select2" name="book" id="book" required>
                            <option value=""><?php echo e(__('select')); ?></option>
                            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($book->id); ?>" <?php if(old('book') == $book->id): ?> selected <?php endif; ?>><?php echo e($book->isbn); ?> | <?php echo e($book->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <div class="invalid-feedback">
                          <?php echo e(__('required_field')); ?> <?php echo e(__('field_book')); ?>

                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="member"><?php echo e(__('field_member')); ?> <span>*</span></label>
                        <select class="form-control select2" name="member" id="member" required>
                            <option value=""><?php echo e(__('select')); ?></option>
                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($member->id); ?>" <?php if(old('member') == $member->id): ?> selected <?php endif; ?>><?php echo e($member->library_id); ?> | <?php echo e($member->memberable->first_name ?? ''); ?> <?php echo e($member->memberable->last_name ?? ''); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <div class="invalid-feedback">
                          <?php echo e(__('required_field')); ?> <?php echo e(__('field_member')); ?>

                        </div>
                    </div>

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
    </div><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\issue-return\create.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('page_css'); ?>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/css/prints/certificate.css')); ?>" media="screen">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e($title); ?></h5>
                    </div>
                    <div class="card-block">
                        <form class="needs-validation" novalidate method="get" action="<?php echo e(route($route.'.index')); ?>">
                            <div class="row gx-2">
                                <div class="form-group col-md-2">
                                    <label for="batch"><?php echo e(__('field_batch')); ?></label>
                                    <select class="form-control" name="batch" id="batch" required>
                                        <option value="0"><?php echo e(__('all')); ?></option>
                                        <?php $__currentLoopData = $batchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($batch->id); ?>" <?php if( $selected_batch == $batch->id): ?> selected <?php endif; ?>><?php echo e($batch->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <div class="invalid-feedback">
                                      <?php echo e(__('required_field')); ?> <?php echo e(__('field_batch')); ?>

                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="program"><?php echo e(__('field_program')); ?></label>
                                    <select class="form-control" name="program" id="program" required>
                                        <option value="0"><?php echo e(__('all')); ?></option>
                                        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($program->id); ?>" <?php if( $selected_program == $program->id): ?> selected <?php endif; ?>><?php echo e($program->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <div class="invalid-feedback">
                                      <?php echo e(__('required_field')); ?> <?php echo e(__('field_program')); ?>

                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="student_id"><?php echo e(__('field_student_id')); ?></label>
                                    <input type="text" class="form-control" name="student_id" id="student_id" value="<?php echo e($selected_student_id); ?>">

                                    <div class="invalid-feedback">
                                      <?php echo e(__('required_field')); ?> <?php echo e(__('field_student_id')); ?>

                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="template"><?php echo e(__('field_certificate')); ?> <span>*</span></label>
                                    <select class="form-control" name="template" id="template" required>
                                        <option value=""><?php echo e(__('select')); ?></option>
                                        <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($template->id); ?>" <?php if( $selected_template == $template->id): ?> selected <?php endif; ?>><?php echo e($template->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <div class="invalid-feedback">
                                      <?php echo e(__('required_field')); ?> <?php echo e(__('field_certificate')); ?>

                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-info btn-filter"><i class="fas fa-search"></i> <?php echo e(__('btn_search')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <?php if(isset($rows)): ?>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('field_student_id')); ?></th>
                                        <th><?php echo e(__('field_name')); ?></th>
                                        <th><?php echo e(__('field_batch')); ?></th>
                                        <th><?php echo e(__('field_program')); ?></th>
                                        <th><?php echo e(__('field_status')); ?></th>
                                        <th><?php echo e(__('field_action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php if(isset($row->student_id)): ?>
                                            <a href="<?php echo e(route('admin.student.show', $row->id)); ?>">
                                            #<?php echo e($row->student_id); ?>

                                            </a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($row->first_name); ?> <?php echo e($row->last_name); ?></td>
                                        <td><?php echo e($row->batch->title ?? ''); ?></td>
                                        <td><?php echo e($row->program->shortcode ?? ''); ?></td>
                                        
                                        <?php
                                            $certificate_generate = 0;
                                        ?>
                                        <?php if(isset($certificates)): ?>
                                        <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($certificate->student_id == $row->id): ?>
                                            <?php
                                                $certificate_generate = 1;
                                            ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <td>
                                            <?php if( $certificate_generate == 1 ): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__('status_generated')); ?></span>
                                            <?php else: ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__('status_not_generated')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if( $certificate_generate == 0 ): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-create')): ?>
                                            <button type="button" class="btn btn-icon btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal-<?php echo e($row->id); ?>">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <!-- Include Show modal -->
                                            <?php echo $__env->make($view.'.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endif; ?>

                                            <?php else: ?>

                                            <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($certificate->student_id == $row->id): ?>

                                            <button type="button" class="btn btn-icon btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#showModal-<?php echo e($row->id); ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <!-- Include Show modal -->
                                            <?php echo $__env->make($view.'.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-print')): ?>
                                            <?php if(isset($certificate_template)): ?>
                                            <a href="#" class="btn btn-icon btn-dark btn-sm" onclick="PopupWin('<?php echo e(route($route.'.print', ['id' => $certificate->id])); ?>', '<?php echo e($title); ?>', 1000, 600);">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-download')): ?>
                                            <?php if(isset($certificate_template)): ?>
                                            <a href="<?php echo e(route($route.'.download', ['id' => $certificate->id])); ?>" target="_blank" class="btn btn-icon btn-dark btn-sm">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($access.'-edit')): ?>
                                            <button type="button" class="btn btn-icon btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo e($row->id); ?>">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <!-- Include Edit modal -->
                                            <?php echo $__env->make($view.'.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endif; ?>

                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\certificate\index.blade.php ENDPATH**/ ?>
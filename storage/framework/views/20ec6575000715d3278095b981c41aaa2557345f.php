
<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('page_css'); ?>
    <!-- Full calendar css -->
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/plugins/fullcalendar/css/fullcalendar.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">

            <?php
                function field($slug){
                    return \App\Models\Field::field($slug);
                }
            ?>

            <?php if(field('panel_assignment')->status == 1): ?>
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <?php if(isset($assignments)): ?>
                    <div class="card-header">
                        <h5><?php echo e(trans_choice('module_assignment', 2)); ?></h5>
                    </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('field_title')); ?></th>
                                        <th><?php echo e(__('field_subject')); ?></th>
                                        <th><?php echo e(__('field_status')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($row->assignment->status == 1): ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('student.assignment.show', $row->id)); ?>"><?php echo str_limit($row->assignment->title ?? '', 50, ' ...'); ?></a>
                                        </td>
                                        <td><?php echo e($row->assignment->subject->code ?? ''); ?></td>
                                        <td>
                                            <?php if( $row->attendance == 1 ): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__('status_submitted')); ?></span>
                                            <?php else: ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__('status_pending')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if(field('panel_fees_report')->status == 1): ?>
            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <?php if(isset($fees)): ?>
                    <div class="card-header">
                        <h5><?php echo e(trans_choice('module_student_fees', 2)); ?></h5>
                    </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('field_fees_type')); ?></th>
                                        <th><?php echo e(__('field_fee')); ?></th>
                                        <th><?php echo e(__('field_status')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($row->category->title ?? ''); ?></td>
                                        <td>
                                            <?php if(isset($setting->decimal_place)): ?>
                                            <?php echo e(number_format((float)$row->fee_amount, $setting->decimal_place, '.', '')); ?> 
                                            <?php else: ?>
                                            <?php echo e(number_format((float)$row->fee_amount, 2, '.', '')); ?> 
                                            <?php endif; ?> 
                                            <?php echo $setting->currency_symbol; ?>

                                        </td>
                                        <td>
                                            <?php if($row->status == 1): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__('status_paid')); ?></span>
                                            <?php elseif($row->status == 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__('status_canceled')); ?></span>
                                            <?php else: ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__('status_pending')); ?></span>
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

            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e(trans_choice('module_notification', 2)); ?></h5>
                    </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('field_title')); ?></th>
                                        <th><?php echo e(__('field_type')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = Auth::guard('student')->user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if($key < 10): ?>
                                    <?php
                                    $notification_link = 'student.dashboard.index';
                                    $notification_type = '';
                                    if($notification->data['type'] == 'content') {
                                    $notification_link = 'student.download.show';
                                    $notification_type = trans_choice('module_content', 1);
                                    }
                                    elseif( $notification->data['type'] == 'notice') {
                                    $notification_link = 'student.notice.show';
                                    $notification_type = trans_choice('module_notice', 1);
                                    }
                                    elseif($notification->data['type'] == 'assignment'){
                                    $notification_link = 'student.assignment.index';
                                    $notification_type = trans_choice('module_assignment', 1);
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <?php if($notification->data['type'] == 'assignment'): ?>
                                            <a class="media" href="<?php echo e(route($notification_link)); ?>"><?php echo e(str_limit($notification->data['title'], 30, ' ...')); ?></a> <span><?php echo e($notification->created_at->diffForHumans()); ?></span>
                                            <?php else: ?>
                                            <a class="media" href="<?php echo e(route($notification_link, $notification->data['id'])); ?>"><?php echo e(str_limit($notification->data['title'], 30, ' ...')); ?></a> <span><?php echo e($notification->created_at->diffForHumans()); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($notification_type); ?></td>
                                    </tr>
                                  <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
 
        <div class="row">
            <div class="col-xl-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e(trans_choice('module_calendar', 2)); ?></h5>
                    </div>
                    <div class="card-block">

                        <!-- [ Calendar ] start -->
                        <div id='calendar' class='calendar'></div>
                        <!-- [ Calendar ] end -->

                    </div>
                </div>
            </div>
            <!-- [Event List] start -->
            <div class="col-xl-4 col-md-4 col-sm-12">
                <div class="card statistial-visit">
                    <div class="card-header">
                        <h5><?php echo e(__('upcoming')); ?> <?php echo e(trans_choice('module_event', 1)); ?></h5>
                    </div>
                    <div class="card-block">
                        <?php $__currentLoopData = $latest_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $latest_event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key <= 9): ?>
                        <p>
                        <mark style="color: <?php echo e($latest_event->color); ?>">
                            <i class="fas fa-calendar-check"></i> <?php echo e($latest_event->title); ?>

                        </mark>
                        <br>
                        <small>
                            <?php if(isset($setting->date_format)): ?>
                            <?php echo e(date($setting->date_format, strtotime($latest_event->start_date))); ?>

                            <?php else: ?>
                            <?php echo e(date("Y-m-d", strtotime($latest_event->start_date))); ?>

                            <?php endif; ?>

                            <?php if($latest_event->start_date != $latest_event->end_date): ?>
                             <i class="fas fa-exchange-alt"></i> 
                            <?php if(isset($setting->date_format)): ?>
                            <?php echo e(date($setting->date_format, strtotime($latest_event->end_date))); ?>

                            <?php else: ?>
                            <?php echo e(date("Y-m-d", strtotime($latest_event->end_date))); ?>

                            <?php endif; ?>
                            <?php endif; ?>
                        </small>
                        </p>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <!-- [Event List] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_js'); ?>
    <!-- Full calendar js -->
    <script src="<?php echo e(asset('dashboard/plugins/fullcalendar/js/lib/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/plugins/fullcalendar/js/lib/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/plugins/fullcalendar/js/fullcalendar.min.js')); ?>"></script>


    <script type="text/javascript">
        // Full calendar
        $(window).on('load', function() {
            "use strict";
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'today'
                },
                defaultDate: '<?php echo date("Y-m-d"); ?>',
                editable: false,
                droppable: false,
                events: [

                <?php
                    foreach($events as $key => $row){
                        echo "{
                                title: '".$row->title."',
                                start: '".$row->start_date."',
                                end: '".$row->end_date."',
                                borderColor: '".$row->color."',
                                backgroundColor: '".$row->color."',
                                textColor: '#fff'
                            }, ";
                    }
                ?>

                ],
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('student.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\student\index.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <?php $__env->startSection('title', 'My Stocks'); ?>
    <?php echo $__env->make('admin.layouts.common.header_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .sd-table-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.04);
            padding: 20px;
            margin-bottom: 25px;
        }
        .sd-table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .sd-table-header h6 {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0;
        }
        .sd-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .sd-table th {
            background: #f8f9fa;
            padding: 10px 14px;
            font-size: 12px;
            font-weight: 600;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #eee;
        }
        .sd-table td {
            padding: 12px 14px;
            font-size: 13px;
            color: #333;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }
        .sd-table tr:last-child td { border-bottom: none; }
        .sd-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .sd-badge-active { background: #d4edda; color: #155724; }
        .sd-badge-inactive { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar active-lightblue title-lightblue navbar-lightblue brand-lightblue navbar-image-4 menu-item-icon-style2 <?php echo e(\Cookie::get('sidebar')); ?>">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <?php if(isset($setting) && !empty($setting->logo_path) && file_exists(public_path('uploads/setting/'.$setting->logo_path))): ?>
                <a href="<?php echo e(route('supplier.dashboard.index')); ?>" class="b-brand">
                    <img src="<?php echo e(asset('uploads/setting/'.$setting->logo_path)); ?>" alt="logo">
                </a>
                <?php endif; ?>
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>

            <!-- Supplier Sidebar Menu content -->
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('supplier.dashboard.index')); ?>" class="nav-link">
                            <span class="pcoded-micon"><i class="fas fa-th-large"></i></span>
                            <span class="pcoded-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('supplier.order.index')); ?>" class="nav-link">
                            <span class="pcoded-micon"><i class="fas fa-file-invoice"></i></span>
                            <span class="pcoded-mtext">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('supplier.stock.index')); ?>" class="nav-link">
                            <span class="pcoded-micon"><i class="fas fa-boxes"></i></span>
                            <span class="pcoded-mtext">My Stocks</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('supplier.product.category.index')); ?>" class="nav-link">
                            <span class="pcoded-micon"><i class="fas fa-tags"></i></span>
                            <span class="pcoded-mtext">Products</span>
                        </a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Account Pages</label>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('supplier.profile.index')); ?>" class="nav-link">
                            <span class="pcoded-micon"><i class="fas fa-user"></i></span>
                            <span class="pcoded-mtext">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="pcoded-micon"><i class="fas fa-sign-out-alt"></i></span>
                            <span class="pcoded-mtext">Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-lightblue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            <?php if(isset($setting) && !empty($setting->logo_path) && file_exists(public_path('uploads/setting/'.$setting->logo_path))): ?>
            <a href="<?php echo e(route('supplier.dashboard.index')); ?>" class="b-brand">
                <div class="b-bg">
                    <img src="<?php echo e(asset('uploads/setting/'.$setting->logo_path)); ?>" alt="logo" height="20">
                </div>
            </a>
            <?php endif; ?>
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <li>
                    <h4 class="topbar-title"><?php echo e($setting->title ?? 'Supplier Portal'); ?></h4>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <!-- Language -->
                <li>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <?php 
                            $version = App\Models\Language::version(); 
                            ?>
                            <i class="fas fa-language"></i> <?php echo e($version->name); ?>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0"><?php echo e(trans_choice('module_language', 2)); ?></h6>
                            </div>
                            <ul class="noti-body">
                                <?php $__currentLoopData = $user_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="notification <?php if(\Session()->get('locale') == $user_language->code): ?> active <?php endif; ?>">
                                    <a class="language" href="<?php echo e(route('version', $user_language->code)); ?>"><?php echo e($user_language->name); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </li>

                <!-- Notification -->
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="icon feather icon-bell">
                            <?php if(Auth::guard('supplier')->check() && !empty(Auth::guard('supplier')->user()->unreadNotifications) && Auth::guard('supplier')->user()->unreadNotifications->count() > 0): ?>
                            <span class="notification-active"></span>
                            <?php endif; ?>
                            </i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0"><?php echo e(trans_choice('module_notification', 2)); ?></h6>
                            </div>
                            <ul class="noti-body">
                                <?php if(Auth::guard('supplier')->check() && !empty(Auth::guard('supplier')->user()->unreadNotifications)): ?>
                                    <?php $__empty_1 = true; $__currentLoopData = Auth::guard('supplier')->user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php if($key < 10): ?>
                                        <li class="notification">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p><strong><?php echo e($notification->data['title']); ?></strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i><?php echo e($notification->created_at->diffForHumans()); ?></span></p>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <li class="notification"><?php echo e(__('status_no_notification')); ?></li>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <li class="notification"><?php echo e(__('status_no_notification')); ?></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </li>

                <!-- User Profile -->
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="far fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="<?php echo e(asset('dashboard/images/user/avatar-2.jpg')); ?>" class="img-radius" alt="User Profile">
                                <span><?php echo e(Auth::guard('supplier')->user()->title ?? 'Supplier'); ?></span>

                                <a href="javascript:void(0);" class="dud-logout" title="Logout"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i>
                                </a>

                                <form id="logout-form" action="<?php echo e(route('supplier.logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                            <ul class="pro-body">
                                <li><a href="<?php echo e(route('supplier.dashboard.index')); ?>" class="dropdown-item"><i class="feather icon-home"></i> Dashboard</a></li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="feather icon-log-out"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            
                            <div class="page-header mb-4">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <ul class="breadcrumb" style="background: transparent; padding: 0; margin-bottom: 5px;">
                                                <li class="breadcrumb-item"><a href="<?php echo e(route('supplier.dashboard.index')); ?>" class="text-muted">Pages</a></li>
                                                <li class="breadcrumb-item text-muted">My Stocks</li>
                                            </ul>
                                            <div class="page-header-title">
                                                <h5 class="m-b-10" style="font-weight: 700; color: #333;">My Stocks</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <div class="card" style="border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: none;">
                                        <div class="card-header text-white" style="background-color: #0d6efd; border-radius: 10px 10px 0 0; padding: 20px;">
                                            <h5 class="text-white m-0" style="font-weight: 600;">Stocks Supplied</h5>
                                        </div>
                                        <div class="card-body" style="padding: 0;">
                                            <div class="table-responsive">
                                                <table class="table" style="margin: 0; font-size: 13px;">
                                                    <thead style="background: #f8f9fa;">
                                                        <tr>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 15px 20px;">#</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 15px 20px;">ITEM NAME</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 15px 20px;">STORE</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 15px 20px;">QUANTITY</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 15px 20px;">PRICE</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 15px 20px;">DATE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__empty_1 = true; $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td style="padding: 15px 20px; vertical-align: middle;"><?php echo e($key + 1); ?></td>
                                                            <td style="padding: 15px 20px; vertical-align: middle; font-weight: 500;"><?php echo e($stock->item->name ?? '-'); ?></td>
                                                            <td style="padding: 15px 20px; vertical-align: middle; color: #555;"><?php echo e($stock->store->title ?? '-'); ?></td>
                                                            <td style="padding: 15px 20px; vertical-align: middle; color: #555;"><?php echo e($stock->quantity ?? '-'); ?></td>
                                                            <td style="padding: 15px 20px; vertical-align: middle; color: #555;"><?php echo e($stock->price ?? '-'); ?></td>
                                                            <td style="padding: 15px 20px; vertical-align: middle; color: #555;"><?php echo e($stock->date ?? '-'); ?></td>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center text-muted" style="padding: 30px;">No stocks found</td>
                                                        </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- ===== SCRIPTS ===== -->
    <?php echo $__env->make('admin.layouts.common.footer_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\university\resources\views/supplier/stock/index.blade.php ENDPATH**/ ?>
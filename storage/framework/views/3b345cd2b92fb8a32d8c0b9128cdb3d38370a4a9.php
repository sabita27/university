<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <?php $__env->startSection('title', 'Orders'); ?>
    <?php echo $__env->make('admin.layouts.common.header_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        /* Stats cards custom styling */
        .sd-stats-row {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }
        .sd-stat-card {
            flex: 1;
            min-width: 160px;
            background: #fff;
            border-radius: 12px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .sd-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        }
        .sd-stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #fff;
            flex-shrink: 0;
        }
        .sd-stat-icon.bg-purple { background: linear-gradient(135deg, #667eea, #764ba2); }
        .sd-stat-icon.bg-green { background: linear-gradient(135deg, #11998e, #38ef7d); }
        .sd-stat-icon.bg-orange { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .sd-stat-icon.bg-blue { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .sd-stat-icon.bg-indigo { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
        .sd-stat-label { font-size: 12px; color: #888; font-weight: 500; margin-bottom: 2px; }
        .sd-stat-value { font-size: 22px; font-weight: 700; color: #1a1a2e; }

        /* Chart cards */
        .sd-chart-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.04);
            overflow: hidden;
            margin-bottom: 25px;
        }
        .sd-chart-header {
            padding: 18px 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .sd-chart-title {
            font-size: 15px;
            font-weight: 700;
            color: #1a1a2e;
        }
        .sd-chart-body {
            padding: 15px 20px 20px;
            position: relative;
        }

        /* Tables and lists */
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
        .sd-action-btn {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: none;
            font-size: 12px;
            color: #fff;
            cursor: pointer;
            margin-right: 4px;
        }
        .sd-action-view { background: #17a2b8; }
        .sd-action-edit { background: #28a745; }

        /* Quick actions block */
        .sd-quick-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .sd-quick-btn {
            background: #f8f9fa;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 18px 14px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: #333;
        }
        .sd-quick-btn:hover {
            background: #e8f0fe;
            border-color: #0d6efd;
            color: #0d6efd;
            text-decoration: none;
            transform: translateY(-2px);
        }
        .sd-quick-btn i {
            font-size: 22px;
            display: block;
            margin-bottom: 8px;
            color: #0d6efd;
        }
        .sd-quick-btn span {
            font-size: 12px;
            font-weight: 600;
        }
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
                    <h4 class="topbar-title"><?php echo e($setting->title ?? 'Srusti Academy of Management and Technology'); ?></h4>
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
                                                <li class="breadcrumb-item text-muted">Orders</li>
                                            </ul>
                                            <div class="page-header-title">
                                                <h5 class="m-b-10" style="font-weight: 700; color: #333;">Orders</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- ===== Active / Pending Orders ===== -->
                                <div class="col-sm-12 mb-4">
                                    <div class="card" style="border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: none;">
                                        <div class="card-header text-white" style="background-color: #0d6efd; border-radius: 10px 10px 0 0; padding: 20px; display:flex; align-items:center; justify-content:space-between;">
                                            <h5 class="text-white m-0" style="font-weight: 600;">
                                                <i class="fas fa-clock me-2"></i> Active Orders
                                            </h5>
                                            <span class="badge" style="background:rgba(255,255,255,0.25); color:#fff; font-size:13px; padding:5px 14px; border-radius:20px;">
                                                <?php echo e($activeOrders->count()); ?> pending
                                            </span>
                                        </div>
                                        <?php if($activeOrders->count() > 0): ?>
                                        <div class="card-body" style="padding: 0;">
                                            <div class="table-responsive">
                                                <table class="table" style="margin: 0; font-size: 13px;">
                                                    <thead style="background: #f8f9fa;">
                                                        <tr>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">#</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">ORDER NUMBER</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">ITEMS REQUESTED</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">REQUESTED BY</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">REQUEST DATE</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">URGENCY</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">STATUS</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $activeOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td style="padding: 14px 20px; vertical-align: middle;"><?php echo e($key + 1); ?></td>
                                                            <td style="padding: 14px 20px; vertical-align: middle; font-weight: 600; color: #0d6efd;"><?php echo e($order->procurement_number ?? '-'); ?></td>
                                                            <td style="padding: 14px 20px; vertical-align: middle;">
                                                                <?php if($order->assets && count($order->assets) > 0): ?>
                                                                    <?php $__currentLoopData = $order->assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <span style="display:inline-block; background:#e8f0fe; color:#0d6efd; border-radius:4px; padding:2px 8px; font-size:11px; font-weight:600; margin:1px;">
                                                                            <?php echo e($asset['type_title'] ?? $asset['brand_title'] ?? 'Item'); ?> (Qty: <?php echo e($asset['quantity'] ?? '-'); ?>)
                                                                        </span>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php else: ?>
                                                                    <span class="text-muted">-</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td style="padding: 14px 20px; vertical-align: middle; color: #555;"><?php echo e($order->name ?? '-'); ?></td>
                                                            <td style="padding: 14px 20px; vertical-align: middle; color: #555;">
                                                                <?php echo e($order->request_date ? $order->request_date->format('Y-m-d') : '-'); ?>

                                                            </td>
                                                            <td style="padding: 14px 20px; vertical-align: middle;">
                                                                <?php $urgency = $order->urgency ?? 'Normal'; ?>
                                                                <?php if(str_contains(strtolower($urgency), 'urgent') || str_contains(strtolower($urgency), '24') || str_contains(strtolower($urgency), '48')): ?>
                                                                    <span style="background:#dc3545; color:#fff; padding:3px 10px; border-radius:4px; font-size:11px; font-weight:700;"><?php echo e($urgency); ?></span>
                                                                <?php elseif(str_contains(strtolower($urgency), '7')): ?>
                                                                    <span style="background:#fd7e14; color:#fff; padding:3px 10px; border-radius:4px; font-size:11px; font-weight:700;"><?php echo e($urgency); ?></span>
                                                                <?php else: ?>
                                                                    <span style="background:#6c757d; color:#fff; padding:3px 10px; border-radius:4px; font-size:11px; font-weight:700;"><?php echo e($urgency); ?></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td style="padding: 14px 20px; vertical-align: middle;">
                                                                <span style="background: #ff9800; color: #fff; padding: 4px 12px; border-radius: 4px; font-weight: 600; font-size: 11px;">PENDING</span>
                                                            </td>
                                                            <td style="padding: 14px 20px; vertical-align: middle;">
                                                                <button type="button"
                                                                    class="btn-view-detail"
                                                                    data-order-number="<?php echo e($order->procurement_number); ?>"
                                                                    data-name="<?php echo e($order->name); ?>"
                                                                    data-purpose="<?php echo e($order->purpose); ?>"
                                                                    data-date="<?php echo e($order->request_date ? $order->request_date->format('Y-m-d') : '-'); ?>"
                                                                    data-urgency="<?php echo e($order->urgency ?? 'Normal'); ?>"
                                                                    data-status="<?php echo e($order->status); ?>"
                                                                    data-assets="<?php echo e(json_encode($order->assets ?? [])); ?>"
                                                                    style="background:#0d6efd; color:#fff; border:none; border-radius:5px; padding:5px 12px; font-size:12px; cursor:pointer;">
                                                                    <i class="fas fa-eye"></i> View
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="card-body text-center py-5">
                                            <i class="fas fa-check-circle" style="font-size:40px; color:#28a745; opacity:0.4; display:block; margin-bottom:12px;"></i>
                                            <h6 class="text-muted" style="font-weight: 600; letter-spacing: 0.5px;">NO ACTIVE ORDERS FOUND</h6>
                                            <p class="text-muted" style="font-size:13px;">All pending orders will appear here.</p>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- ===== All Quotation Orders ===== -->
                                <div class="col-sm-12 mb-4">
                                    <div class="card" style="border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: none;">
                                        <div class="card-header text-white" style="background-color: #0d6efd; border-radius: 10px 10px 0 0; padding: 20px;">
                                            <h5 class="text-white m-0" style="font-weight: 600;">
                                                <i class="fas fa-list-alt me-2"></i> All Quotation Orders
                                            </h5>
                                        </div>
                                        <div class="card-body" style="padding: 0;">
                                            <div class="table-responsive">
                                                <table class="table" style="margin: 0; font-size: 13px;">
                                                    <thead style="background: #f8f9fa;">
                                                        <tr>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">#</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">ORDER NUMBER</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">PROCUREMENT ITEMS</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">REQUESTED BY</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">REQUEST DATE</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">STATUS</th>
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 14px 20px;">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td style="padding: 14px 20px; vertical-align: middle;"><?php echo e($orders->firstItem() + $key); ?></td>
                                                            <td style="padding: 14px 20px; vertical-align: middle; color: #0d6efd; font-weight: 600;"><?php echo e($order->procurement_number ?? '-'); ?></td>
                                                            <td style="padding: 14px 20px; vertical-align: middle;">
                                                                <?php if($order->assets && count($order->assets) > 0): ?>
                                                                    <?php $__currentLoopData = $order->assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <span style="display:inline-block; background:#f0f4ff; color:#555; border-radius:4px; padding:2px 8px; font-size:11px; margin:1px;">
                                                                            <?php echo e($asset['type_title'] ?? '-'); ?>

                                                                        </span>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php else: ?>
                                                                    <span class="text-muted">-</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td style="padding: 14px 20px; vertical-align: middle; color: #555;"><?php echo e($order->name ?? '-'); ?></td>
                                                            <td style="padding: 14px 20px; vertical-align: middle; color: #555;">
                                                                <?php echo e($order->request_date ? $order->request_date->format('Y-m-d') : '-'); ?>

                                                            </td>
                                                            <td style="padding: 14px 20px; vertical-align: middle;">
                                                                <?php if($order->status == 1): ?>
                                                                    <span style="background: #ff9800; color: #fff; padding: 4px 12px; border-radius: 4px; font-weight: 600; font-size: 11px;">PENDING</span>
                                                                <?php elseif($order->status == 2): ?>
                                                                    <span style="background: #4caf50; color: #fff; padding: 4px 12px; border-radius: 4px; font-weight: 600; font-size: 11px;">APPROVED</span>
                                                                <?php elseif($order->status == 0): ?>
                                                                    <span style="background: #dc3545; color: #fff; padding: 4px 12px; border-radius: 4px; font-weight: 600; font-size: 11px;">REJECTED</span>
                                                                <?php else: ?>
                                                                    <span style="background: #9e9e9e; color: #fff; padding: 4px 12px; border-radius: 4px; font-weight: 600; font-size: 11px;">UNKNOWN</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td style="padding: 14px 20px; vertical-align: middle;">
                                                                <button type="button"
                                                                    class="btn-view-detail"
                                                                    data-order-number="<?php echo e($order->procurement_number); ?>"
                                                                    data-name="<?php echo e($order->name); ?>"
                                                                    data-purpose="<?php echo e($order->purpose); ?>"
                                                                    data-date="<?php echo e($order->request_date ? $order->request_date->format('Y-m-d') : '-'); ?>"
                                                                    data-urgency="<?php echo e($order->urgency ?? 'Normal'); ?>"
                                                                    data-status="<?php echo e($order->status); ?>"
                                                                    data-assets="<?php echo e(json_encode($order->assets ?? [])); ?>"
                                                                    style="background:#0d6efd; color:#fff; border:none; border-radius:5px; padding:5px 12px; font-size:12px; cursor:pointer;">
                                                                    <i class="fas fa-eye"></i> View
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td colspan="7" class="text-center text-muted" style="padding: 30px;">No orders found</td>
                                                        </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php if($orders->hasPages()): ?>
                                            <div style="padding: 15px 20px;"><?php echo e($orders->links()); ?></div>
                                            <?php endif; ?>
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

    <!-- ===== Order Detail Modal ===== -->
    <div class="modal fade" id="orderDetailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius:10px; border:none;">
                <div class="modal-header" style="background:#0d6efd; border-radius:10px 10px 0 0; padding:18px 24px;">
                    <h5 class="modal-title text-white" style="font-weight:700;"><i class="fas fa-file-invoice me-2"></i> Order Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="padding:24px;">
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div style="background:#f8f9fa; border-radius:8px; padding:14px;">
                                <div style="font-size:11px; color:#888; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Order Number</div>
                                <div id="mod-order-number" style="font-size:15px; font-weight:700; color:#0d6efd;"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background:#f8f9fa; border-radius:8px; padding:14px;">
                                <div style="font-size:11px; color:#888; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Requested By</div>
                                <div id="mod-name" style="font-size:15px; font-weight:600; color:#333;"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background:#f8f9fa; border-radius:8px; padding:14px;">
                                <div style="font-size:11px; color:#888; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Request Date</div>
                                <div id="mod-date" style="font-size:15px; font-weight:600; color:#333;"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background:#f8f9fa; border-radius:8px; padding:14px;">
                                <div style="font-size:11px; color:#888; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Urgency</div>
                                <div id="mod-urgency" style="font-size:15px; font-weight:600; color:#333;"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background:#f8f9fa; border-radius:8px; padding:14px;">
                                <div style="font-size:11px; color:#888; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Status</div>
                                <div id="mod-status"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background:#f8f9fa; border-radius:8px; padding:14px;">
                                <div style="font-size:11px; color:#888; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Purpose</div>
                                <div id="mod-purpose" style="font-size:13px; color:#555;"></div>
                            </div>
                        </div>
                    </div>

                    <h6 style="font-weight:700; color:#333; margin-bottom:12px;"><i class="fas fa-boxes me-2 text-primary"></i>Requested Items</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-size:13px;">
                            <thead style="background:#f0f4ff;">
                                <tr>
                                    <th style="color:#555; font-weight:700;">#</th>
                                    <th style="color:#555; font-weight:700;">Item Type</th>
                                    <th style="color:#555; font-weight:700;">Brand</th>
                                    <th style="color:#555; font-weight:700;">Quantity</th>
                                    <th style="color:#555; font-weight:700;">Specification</th>
                                </tr>
                            </thead>
                            <tbody id="mod-assets-body"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #eee; padding:14px 24px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== SCRIPTS ===== -->
    <?php echo $__env->make('admin.layouts.common.footer_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function() {
            $('.btn-view-detail').on('click', function() {
                let orderNum = $(this).data('order-number');
                let name = $(this).data('name');
                let purpose = $(this).data('purpose');
                let date = $(this).data('date');
                let urgency = $(this).data('urgency');
                let status = $(this).data('status');
                let assets = $(this).data('assets');

                $('#mod-order-number').text(orderNum);
                $('#mod-name').text(name);
                $('#mod-date').text(date);
                $('#mod-urgency').text(urgency);
                $('#mod-purpose').text(purpose || '-');

                // Status badge
                let statusBadge = '';
                if (status == 1) statusBadge = '<span style="background:#ff9800;color:#fff;padding:4px 14px;border-radius:4px;font-weight:700;font-size:12px;">PENDING</span>';
                else if (status == 2) statusBadge = '<span style="background:#4caf50;color:#fff;padding:4px 14px;border-radius:4px;font-weight:700;font-size:12px;">APPROVED</span>';
                else if (status == 0) statusBadge = '<span style="background:#dc3545;color:#fff;padding:4px 14px;border-radius:4px;font-weight:700;font-size:12px;">REJECTED</span>';
                else statusBadge = '<span style="background:#9e9e9e;color:#fff;padding:4px 14px;border-radius:4px;font-weight:700;font-size:12px;">UNKNOWN</span>';
                $('#mod-status').html(statusBadge);

                // Assets table
                let tbody = $('#mod-assets-body');
                tbody.empty();
                if (assets && assets.length > 0) {
                    assets.forEach(function(a, i) {
                        tbody.append(`<tr>
                            <td>${i + 1}</td>
                            <td>${a.type_title || '-'}</td>
                            <td>${a.brand_title || '-'}</td>
                            <td><strong>${a.quantity || '-'}</strong></td>
                            <td>${a.specification || '-'}</td>
                        </tr>`);
                    });
                } else {
                    tbody.append('<tr><td colspan="5" class="text-center text-muted">No items found</td></tr>');
                }

                $('#orderDetailModal').modal('show');
            });
        });
    </script>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\university\resources\views\supplier\order\index.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <?php $__env->startSection('title', 'Supplier Dashboard'); ?>
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
    <?php echo $__env->make('supplier.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            
                            <h4 class="mb-4">Supplier Dashboard</h4>

                            <!-- Stats Row -->
                            <div class="sd-stats-row">
                                <div class="sd-stat-card">
                                    <div class="sd-stat-icon bg-purple"><i class="fas fa-th"></i></div>
                                    <div>
                                        <div class="sd-stat-label">My Categories</div>
                                        <div class="sd-stat-value"><?php echo e($myCategoriesCount); ?></div>
                                    </div>
                                </div>
                                <div class="sd-stat-card">
                                    <div class="sd-stat-icon bg-green"><i class="fas fa-boxes"></i></div>
                                    <div>
                                        <div class="sd-stat-label">Items I Can Supply</div>
                                        <div class="sd-stat-value"><?php echo e($myItemsCount); ?></div>
                                    </div>
                                </div>
                                <div class="sd-stat-card">
                                    <div class="sd-stat-icon bg-orange"><i class="fas fa-truck-loading"></i></div>
                                    <div>
                                        <div class="sd-stat-label">Stocks Supplied</div>
                                        <div class="sd-stat-value"><?php echo e($totalStocks); ?></div>
                                    </div>
                                </div>
                                <div class="sd-stat-card">
                                    <div class="sd-stat-icon bg-blue"><i class="fas fa-wallet"></i></div>
                                    <div>
                                        <div class="sd-stat-label">Total Supply Value</div>
                                        <div class="sd-stat-value"><?php echo e($setting->currency_symbol ?? '$'); ?><?php echo e(number_format($totalPurchaseAmount, 2)); ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Charts Row -->
                            <div class="row mb-4">
                                <div class="col-lg-7">
                                    <div class="sd-chart-card">
                                        <div class="sd-chart-header">
                                            <div class="sd-chart-title">My Monthly Supplies</div>
                                        </div>
                                        <div class="sd-chart-body">
                                            <canvas id="barChart" height="220"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="sd-chart-card">
                                        <div class="sd-chart-header">
                                            <div class="sd-chart-title">Supply Items by Category</div>
                                        </div>
                                        <div class="sd-chart-body" style="display: flex; align-items: center; justify-content: center;">
                                            <canvas id="doughnutChart" height="220"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Row: Table + Quick Actions -->
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="sd-table-card">
                                        <div class="sd-table-header">
                                            <h6>Items I Can Supply</h6>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="sd-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Item Name</th>
                                                        <th>Category</th>
                                                        <th>Unit</th>
                                                        <th>Serial Number</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_1 = true; $__currentLoopData = $myItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($key + 1); ?></td>
                                                        <td><strong><?php echo e($item->name); ?></strong></td>
                                                        <td><?php echo e($item->category->title ?? '-'); ?></td>
                                                        <td><?php echo e($item->unit ?? '-'); ?></td>
                                                        <td><?php echo e($item->serial_number ?? '-'); ?></td>
                                                        <td>
                                                            <?php if($item->status == 1): ?>
                                                                <span class="sd-badge sd-badge-active">Active</span>
                                                            <?php else: ?>
                                                                <span class="sd-badge sd-badge-inactive">Inactive</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted py-4">No supply items found</td>
                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3 text-muted" style="font-size: 13px;">
                                            Showing 1 to <?php echo e($myItems->count()); ?> of <?php echo e($myItemsCount); ?> entries
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
    
    <script>
        // Bar Chart - Monthly Supplier Registrations (real data)
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($monthlyData, 'label')); ?>,
                datasets: [{
                    label: 'Registrations',
                    data: <?php echo json_encode(array_column($monthlyData, 'count')); ?>,
                    backgroundColor: [
                        'rgba(64, 153, 222, 0.85)',
                        'rgba(64, 153, 222, 0.70)',
                        'rgba(64, 153, 222, 0.85)',
                        'rgba(64, 153, 222, 0.70)',
                        'rgba(64, 153, 222, 0.85)',
                        'rgba(64, 153, 222, 0.70)'
                    ],
                    borderRadius: 6,
                    barThickness: 28
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f0f0f0' }, ticks: { font: { size: 11 }, stepSize: 1 } },
                    x: { grid: { display: false }, ticks: { font: { size: 11 } } }
                }
            }
        });

        // Doughnut Chart - Supply Items by Category
        const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($doughnutLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($doughnutCounts); ?>,
                    backgroundColor: [
                        '#10b981',
                        '#ef4444',
                        '#f59e0b',
                        '#3b82f6',
                        '#8b5cf6',
                        '#ec4899',
                        '#06b6d4',
                        '#f43f5e'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '55%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 15,
                            font: { size: 12 }
                        }
                    }
                }
            }
        });
    </script>
    <form id="logout-form" action="<?php echo e(route('supplier.logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\university\resources\views/supplier/dashboard/index.blade.php ENDPATH**/ ?>
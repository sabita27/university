<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <?php $__env->startSection('title', 'Product Categories'); ?>
    <?php echo $__env->make('admin.layouts.common.header_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .sp-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            border: none;
            margin-bottom: 24px;
        }
        .sp-card-header {
            background: #0d6efd;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sp-card-header h5 { margin: 0; font-weight: 600; font-size: 16px; }
        .btn-sp-add {
            background: #fff;
            color: #0d6efd;
            border: none;
            border-radius: 6px;
            padding: 6px 16px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-sp-add:hover { background: #e8f0fe; color: #0d6efd; text-decoration: none; }
        .sp-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .sp-table th { background: #f8f9fa; color: #888; font-weight: 600; padding: 12px 18px; border-bottom: 1px solid #eee; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; }
        .sp-table td { padding: 14px 18px; border-bottom: 1px solid #f0f0f0; color: #333; vertical-align: middle; }
        .sp-table tr:last-child td { border-bottom: none; }
        .badge-active   { background: #d4edda; color: #155724; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-inactive { background: #f8d7da; color: #721c24; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .btn-action { padding: 4px 10px; border-radius: 5px; font-size: 12px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; margin-right: 4px; display: inline-flex; align-items: center; gap: 4px; }
        .btn-view   { background: #17a2b8; color: #fff; }
        .btn-edit   { background: #28a745; color: #fff; }
        .btn-delete { background: #dc3545; color: #fff; }
        .btn-action:hover { opacity: 0.85; color: #fff; text-decoration: none; }
    </style>
</head>
<body>

    <div class="loader-bg"><div class="loader-track"><div class="loader-fill"></div></div></div>

    <?php echo $__env->make('supplier.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-lightblue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            <?php if(isset($setting) && !empty($setting->logo_path) && file_exists(public_path('uploads/setting/'.$setting->logo_path))): ?>
            <a href="<?php echo e(route('supplier.dashboard.index')); ?>" class="b-brand">
                <div class="b-bg"><img src="<?php echo e(asset('uploads/setting/'.$setting->logo_path)); ?>" alt="logo" height="20"></div>
            </a>
            <?php endif; ?>
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!"><i class="feather icon-more-horizontal"></i></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <li><h4 class="topbar-title"><?php echo e($setting->title ?? 'Supplier Portal'); ?></h4></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-user"></i></a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="<?php echo e(asset('dashboard/images/user/avatar-2.jpg')); ?>" class="img-radius" alt="User">
                                <span><?php echo e(Auth::guard('supplier')->user()->title ?? 'Supplier'); ?></span>
                                <a href="javascript:void(0);" class="dud-logout" onclick="event.preventDefault(); document.getElementById('supplier-logout-form').submit();">
                                    <i class="feather icon-log-out"></i>
                                </a>
                                <form id="supplier-logout-form" action="<?php echo e(route('supplier.logout')); ?>" method="POST" style="display:none;"><?php echo csrf_field(); ?></form>
                            </div>
                            <ul class="pro-body">
                                <li><a href="<?php echo e(route('supplier.dashboard.index')); ?>" class="dropdown-item"><i class="feather icon-home"></i> Dashboard</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item" onclick="document.getElementById('supplier-logout-form').submit()"><i class="feather icon-log-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <!-- [ Main Content ] -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">

                            <div class="page-header mb-4">
                                <div class="page-block">
                                    <ul class="breadcrumb" style="background:transparent;padding:0;margin-bottom:4px;">
                                        <li class="breadcrumb-item"><a href="<?php echo e(route('supplier.dashboard.index')); ?>" class="text-muted">Pages</a></li>
                                        <li class="breadcrumb-item text-muted">Products</li>
                                        <li class="breadcrumb-item text-muted">Categories</li>
                                    </ul>
                                    <h5 style="font-weight:700;color:#333;margin:0;">Product Categories</h5>
                                </div>
                            </div>

                            <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php endif; ?>

                            <div class="sp-card">
                                <div class="sp-card-header">
                                    <h5><i class="fas fa-tags me-2"></i> My Categories</h5>
                                    <a href="<?php echo e(route('supplier.product.category.create')); ?>" class="btn-sp-add">
                                        <i class="fas fa-plus"></i> Add More Category
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="sp-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Items</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $supplierItemIds = is_array(Auth::guard('supplier')->user()->items) ? Auth::guard('supplier')->user()->items : [];
                                            ?>
                                            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($categories->firstItem() + $key); ?></td>
                                                <td><strong><?php echo e($cat->title); ?></strong></td>
                                                <td><?php echo e($cat->description ? \Str::limit($cat->description, 60) : '-'); ?></td>
                                                <td><span class="badge bg-primary"><?php echo e(collect($supplierItemIds)->intersect($cat->items->pluck('id'))->count()); ?></span></td>
                                                <td>
                                                    <?php if($cat->status == 1): ?>
                                                        <span class="badge-active">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge-inactive">Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>

                                                    <form action="<?php echo e(route('supplier.product.category.destroy', $cat->id)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Remove this category from your list?')">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i> Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted" style="padding:30px;">No categories found. <a href="<?php echo e(route('supplier.product.category.create')); ?>">Add one now</a>.</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if($categories->hasPages()): ?>
                                <div style="padding: 15px 18px;"><?php echo e($categories->links()); ?></div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('admin.layouts.common.footer_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\university\resources\views/supplier/product/category/index.blade.php ENDPATH**/ ?>
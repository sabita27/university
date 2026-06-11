<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <?php $__env->startSection('title', 'Edit Category'); ?>
    <?php echo $__env->make('admin.layouts.common.header_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .sp-form-card { background:#fff; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.06); border:none; }
        .sp-form-header { background:#0d6efd; color:#fff; border-radius:10px 10px 0 0; padding:16px 20px; }
        .sp-form-header h5 { margin:0; font-weight:600; font-size:16px; }
        .sp-form-body { padding:28px; }
        .form-label { font-weight:600; font-size:13px; color:#555; }
        .form-control, .form-select { border-radius:7px; font-size:13px; }
        .btn-sp-save { background:#0d6efd; color:#fff; border:none; border-radius:7px; padding:9px 24px; font-weight:600; font-size:14px; }
        .btn-sp-save:hover { background:#0b5ed7; color:#fff; }
        .btn-sp-cancel { background:#f0f0f0; color:#555; border:none; border-radius:7px; padding:9px 24px; font-weight:600; font-size:14px; text-decoration:none; }
        .btn-sp-cancel:hover { background:#e0e0e0; color:#333; text-decoration:none; }
    </style>
</head>
<body>

    <div class="loader-bg"><div class="loader-track"><div class="loader-fill"></div></div></div>

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
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption"><label>Navigation</label></li>
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
                    <li class="nav-item active">
                        <a href="<?php echo e(route('supplier.product.category.index')); ?>" class="nav-link">
                            <span class="pcoded-micon"><i class="fas fa-tags"></i></span>
                            <span class="pcoded-mtext">Products</span>
                        </a>
                    </li>
                    <li class="nav-item pcoded-menu-caption"><label>Account Pages</label></li>
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
                                <a href="javascript:void(0);" class="dud-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i>
                                </a>
                                <form id="logout-form" action="<?php echo e(route('supplier.logout')); ?>" method="POST" style="display:none;"><?php echo csrf_field(); ?></form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>

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
                                        <li class="breadcrumb-item"><a href="<?php echo e(route('supplier.product.category.index')); ?>" class="text-muted">Categories</a></li>
                                        <li class="breadcrumb-item text-muted">Edit</li>
                                    </ul>
                                    <h5 style="font-weight:700;color:#333;margin:0;">Edit Category</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="sp-form-card">
                                        <div class="sp-form-header">
                                            <h5><i class="fas fa-edit me-2"></i> Edit: <?php echo e($category->title); ?></h5>
                                        </div>
                                        <div class="sp-form-body">
                                            <form action="<?php echo e(route('supplier.product.category.update', $category->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                                                <div class="mb-3">
                                                    <label class="form-label">Category Title <span class="text-danger">*</span></label>
                                                    <input type="text" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                           value="<?php echo e(old('title', $category->title)); ?>" placeholder="e.g. Chemistry Lab Equipment">
                                                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                              rows="4" placeholder="Optional description..."><?php echo e(old('description', $category->description)); ?></textarea>
                                                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                                    <select name="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                        <option value="1" <?php echo e(old('status', $category->status) == '1' ? 'selected' : ''); ?>>Active</option>
                                                        <option value="0" <?php echo e(old('status', $category->status) == '0' ? 'selected' : ''); ?>>Inactive</option>
                                                    </select>
                                                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>

                                                <div class="d-flex gap-3">
                                                    <button type="submit" class="btn-sp-save"><i class="fas fa-save me-1"></i> Update Category</button>
                                                    <a href="<?php echo e(route('supplier.product.category.index')); ?>" class="btn-sp-cancel">Cancel</a>
                                                </div>
                                            </form>
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

    <?php echo $__env->make('admin.layouts.common.footer_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\university\resources\views/supplier/product/category/edit.blade.php ENDPATH**/ ?>
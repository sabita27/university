<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('title', 'Add Category')
    @include('admin.layouts.common.header_script')
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

    @include('supplier.layouts.sidebar')

    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-lightblue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            @if(isset($setting) && !empty($setting->logo_path) && file_exists(public_path('uploads/setting/'.$setting->logo_path)))
            <a href="{{ route('supplier.dashboard.index') }}" class="b-brand">
                <div class="b-bg"><img src="{{ asset('uploads/setting/'.$setting->logo_path) }}" alt="logo" height="20"></div>
            </a>
            @endif
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!"><i class="feather icon-more-horizontal"></i></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <li><h4 class="topbar-title">{{ $setting->title ?? 'Supplier Portal' }}</h4></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-user"></i></a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" class="img-radius" alt="User">
                                <span>{{ Auth::guard('supplier')->user()->title ?? 'Supplier' }}</span>
                                <a href="javascript:void(0);" class="dud-logout" onclick="event.preventDefault(); document.getElementById('supplier-logout-form').submit();">
                                    <i class="feather icon-log-out"></i>
                                </a>
                                <form id="supplier-logout-form" action="{{ route('supplier.logout') }}" method="POST" style="display:none;">@csrf</form>
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
                                        <li class="breadcrumb-item"><a href="{{ route('supplier.dashboard.index') }}" class="text-muted">Pages</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('supplier.product.category.index') }}" class="text-muted">Categories</a></li>
                                        <li class="breadcrumb-item text-muted">Add</li>
                                    </ul>
                                    <h5 style="font-weight:700;color:#333;margin:0;">Add New Category</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="sp-form-card">
                                        <div class="sp-form-header">
                                            <h5><i class="fas fa-plus-circle me-2"></i> New Category</h5>
                                        </div>
                                        <div class="sp-form-body">
                                            <form action="{{ route('supplier.product.category.store') }}" method="POST">
                                                @csrf

                                                <div class="mb-4">
                                                    <label class="form-label" style="font-size: 15px; margin-bottom: 15px; display: block; border-bottom: 1px solid #eee; padding-bottom: 10px;">Select Categories</label>
                                                    
                                                    <div class="row">
                                                        @forelse($allCategories as $category)
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-check custom-checkbox">
                                                                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat_{{ $category->id }}"
                                                                    {{ is_array($selectedCategories) && in_array($category->id, $selectedCategories) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                                                                <label class="form-check-label" for="cat_{{ $category->id }}" style="margin-left: 8px; cursor: pointer; font-size: 14px; padding-top: 2px;">
                                                                    {{ $category->title }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @empty
                                                        <div class="col-12 text-muted">No categories available. Please contact admin.</div>
                                                        @endforelse
                                                    </div>
                                                </div>

                                                <div class="mb-4 mt-4">
                                                    <label class="form-label" style="font-size: 15px; margin-bottom: 15px; display: block; border-bottom: 1px solid #eee; padding-bottom: 10px;">Or Add New Category</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label">Category Title</label>
                                                            <input type="text" class="form-control" name="new_category_title" placeholder="Enter new category name...">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control" name="new_category_description" rows="3" placeholder="Enter category description..."></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex gap-3 mt-4 pt-3" style="border-top: 1px solid #eee;">
                                                    <button type="submit" class="btn-sp-save"><i class="fas fa-save me-1"></i> Update Categories</button>
                                                    <a href="{{ route('supplier.product.category.index') }}" class="btn-sp-cancel">Cancel</a>
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

    @include('admin.layouts.common.footer_script')
</body>
</html>

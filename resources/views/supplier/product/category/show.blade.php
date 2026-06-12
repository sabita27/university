<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('title', 'View Category')
    @include('admin.layouts.common.header_script')
    <style>
        .sp-view-card { background:#fff; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.06); border:none; overflow:hidden; }
        .sp-view-header { background:#0d6efd; color:#fff; padding:20px 24px; display:flex; align-items:center; justify-content:space-between; }
        .sp-view-header h5 { margin:0; font-weight:600; font-size:17px; }
        .sp-view-body { padding:24px; }
        .sp-detail-row { display:flex; border-bottom:1px solid #f0f0f0; padding:14px 0; }
        .sp-detail-row:last-child { border-bottom:none; }
        .sp-detail-label { width:160px; font-size:12px; font-weight:700; color:#888; text-transform:uppercase; letter-spacing:0.5px; flex-shrink:0; }
        .sp-detail-value { font-size:14px; color:#333; font-weight:500; }
        .badge-active   { background:#d4edda; color:#155724; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:700; }
        .badge-inactive { background:#f8d7da; color:#721c24; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:700; }
        .sp-items-table { width:100%; border-collapse:collapse; font-size:13px; margin-top:4px; }
        .sp-items-table th { background:#f8f9fa; color:#888; font-weight:600; padding:10px 16px; border-bottom:1px solid #eee; text-transform:uppercase; font-size:11px; letter-spacing:0.5px; }
        .sp-items-table td { padding:12px 16px; border-bottom:1px solid #f0f0f0; color:#333; vertical-align:middle; }
        .sp-items-table tr:last-child td { border-bottom:none; }
        .btn-sp-edit { background:#28a745; color:#fff; border:none; border-radius:7px; padding:8px 20px; font-weight:600; font-size:13px; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
        .btn-sp-edit:hover { background:#218838; color:#fff; text-decoration:none; }
        .btn-sp-back { background:#f0f0f0; color:#555; border:none; border-radius:7px; padding:8px 20px; font-weight:600; font-size:13px; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
        .btn-sp-back:hover { background:#e0e0e0; color:#333; text-decoration:none; }
    </style>
</head>
<body>

    <div class="loader-bg"><div class="loader-track"><div class="loader-fill"></div></div></div>

    <!-- [ navigation menu ] start -->
    @include('supplier.layouts.sidebar')
    <!-- [ navigation menu ] end -->

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
                                <a href="javascript:void(0);" class="dud-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i>
                                </a>
                                <form id="logout-form" action="{{ route('supplier.logout') }}" method="POST" style="display:none;">@csrf</form>
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
                                        <li class="breadcrumb-item text-muted">View</li>
                                    </ul>
                                    <h5 style="font-weight:700;color:#333;margin:0;">Category Details</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-7 mb-4">
                                    <div class="sp-view-card">
                                        <div class="sp-view-header">
                                            <h5><i class="fas fa-tag me-2"></i> {{ $category->title }}</h5>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('supplier.product.category.edit', $category->id) }}" class="btn-sp-edit">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('supplier.product.category.index') }}" class="btn-sp-back">
                                                    <i class="fas fa-arrow-left"></i> Back
                                                </a>
                                            </div>
                                        </div>
                                        <div class="sp-view-body">
                                            <div class="sp-detail-row">
                                                <div class="sp-detail-label">Category ID</div>
                                                <div class="sp-detail-value">#{{ $category->id }}</div>
                                            </div>
                                            <div class="sp-detail-row">
                                                <div class="sp-detail-label">Title</div>
                                                <div class="sp-detail-value">{{ $category->title }}</div>
                                            </div>
                                            <div class="sp-detail-row">
                                                <div class="sp-detail-label">Slug</div>
                                                <div class="sp-detail-value text-muted">{{ $category->slug }}</div>
                                            </div>
                                            <div class="sp-detail-row">
                                                <div class="sp-detail-label">Description</div>
                                                <div class="sp-detail-value">{{ $category->description ?? 'No description provided.' }}</div>
                                            </div>
                                            <div class="sp-detail-row">
                                                <div class="sp-detail-label">Status</div>
                                                <div class="sp-detail-value">
                                                    @if($category->status == 1)
                                                        <span class="badge-active">Active</span>
                                                    @else
                                                        <span class="badge-inactive">Inactive</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="sp-detail-row">
                                                <div class="sp-detail-label">Total Items</div>
                                                <div class="sp-detail-value"><strong>{{ $items->count() }}</strong> items</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="sp-view-card">
                                        <div class="sp-view-header">
                                            <h5><i class="fas fa-boxes me-2"></i> Items in this Category</h5>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="sp-items-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Item Name</th>
                                                        <th>Items</th>
                                                        <th>Serial No.</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($items as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td><strong>{{ $item->name }}</strong></td>
                                                        <td>{{ $item->unit ?? '-' }}</td>
                                                        <td>{{ $item->serial_number ?? '-' }}</td>
                                                        <td>
                                                            @if($item->status == 1)
                                                                <span class="badge-active">Active</span>
                                                            @else
                                                                <span class="badge-inactive">Inactive</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted" style="padding:24px;">No items in this category yet.</td>
                                                    </tr>
                                                    @endforelse
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

    @include('admin.layouts.common.footer_script')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('title', 'My Stocks')
    @include('admin.layouts.common.header_script')
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
    @include('supplier.layouts.sidebar')
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-lightblue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            @if(isset($setting) && !empty($setting->logo_path) && file_exists(public_path('uploads/setting/'.$setting->logo_path)))
            <a href="{{ route('supplier.dashboard.index') }}" class="b-brand">
                <div class="b-bg">
                    <img src="{{ asset('uploads/setting/'.$setting->logo_path) }}" alt="logo" height="20">
                </div>
            </a>
            @endif
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <li>
                    <h4 class="topbar-title">{{ $setting->title ?? 'Supplier Portal' }}</h4>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <!-- Language -->
                <li>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            @php 
                            $version = App\Models\Language::version(); 
                            @endphp
                            <i class="fas fa-language"></i> {{ $version->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">{{ trans_choice('module_language', 2) }}</h6>
                            </div>
                            <ul class="noti-body">
                                @foreach($user_languages as $user_language)
                                <li class="notification @if(\Session()->get('locale') == $user_language->code) active @endif">
                                    <a class="language" href="{{ route('version', $user_language->code) }}">{{ $user_language->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>

                <!-- Notification -->
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="icon feather icon-bell">
                            @if(Auth::guard('supplier')->check() && !empty(Auth::guard('supplier')->user()->unreadNotifications) && Auth::guard('supplier')->user()->unreadNotifications->count() > 0)
                            <span class="notification-active"></span>
                            @endif
                            </i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">{{ trans_choice('module_notification', 2) }}</h6>
                            </div>
                            <ul class="noti-body">
                                @if(Auth::guard('supplier')->check() && !empty(Auth::guard('supplier')->user()->unreadNotifications))
                                    @forelse(Auth::guard('supplier')->user()->unreadNotifications as $key => $notification)
                                        @if($key < 10)
                                        <li class="notification">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p><strong>{{ $notification->data['title'] }}</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>{{ $notification->created_at->diffForHumans() }}</span></p>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                    @empty
                                        <li class="notification">{{ __('status_no_notification') }}</li>
                                    @endforelse
                                @else
                                    <li class="notification">{{ __('status_no_notification') }}</li>
                                @endif
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
                                <img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" class="img-radius" alt="User Profile">
                                <span>{{ Auth::guard('supplier')->user()->title ?? 'Supplier' }}</span>

                                <a href="javascript:void(0);" class="dud-logout" title="Logout"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i>
                                </a>

                                <form id="logout-form" action="{{ route('supplier.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            <ul class="pro-body">
                                <li><a href="{{ route('supplier.dashboard.index') }}" class="dropdown-item"><i class="feather icon-home"></i> Dashboard</a></li>
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
                                                <li class="breadcrumb-item"><a href="{{ route('supplier.dashboard.index') }}" class="text-muted">Pages</a></li>
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
                                        <div class="card-header text-white" style="background-color: #0d6efd; border-radius: 10px 10px 0 0; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
                                            <h5 class="text-white m-0" style="font-weight: 600;">Stocks Supplied</h5>
                                            <a href="{{ route('supplier.stock.create') }}" class="btn btn-light btn-sm text-primary" style="font-weight: 600; border-radius: 6px;">
                                                <i class="fas fa-plus"></i> Add Stock
                                            </a>
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
                                                            <th style="color: #888; font-weight: 600; border-top: none; padding: 15px 20px;">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($stocks as $key => $stock)
                                                        <tr>
                                                            <td style="padding: 15px 20px; vertical-align: middle;">{{ $key + 1 }}</td>
                                                            <td style="padding: 15px 20px; vertical-align: middle; font-weight: 500;">{{ $stock->item->name ?? '-' }}</td>
                                                            <td style="padding: 15px 20px; vertical-align: middle; color: #555;">{{ $stock->store->title ?? '-' }}</td>
                                                            <td style="padding: 15px 20px; vertical-align: middle; color: #555;">{{ $stock->quantity ?? '-' }}</td>
                                                            <td style="padding: 15px 20px; vertical-align: middle; color: #555;">{{ $stock->price ?? '-' }}</td>
                                                            <td style="padding: 15px 20px; vertical-align: middle; color: #555;">{{ $stock->date ?? '-' }}</td>
                                                            <td style="padding: 15px 20px; vertical-align: middle;">
                                                                <a href="{{ route('supplier.stock.edit', $stock->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                                                <form action="{{ route('supplier.stock.destroy', $stock->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this stock?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center text-muted" style="padding: 30px;">No stocks found</td>
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
    </div>
    <!-- [ Main Content ] end -->

    <!-- ===== SCRIPTS ===== -->
    @include('admin.layouts.common.footer_script')
</body>
</html>

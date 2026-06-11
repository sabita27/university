{{-- Supplier Sidebar Partial --}}
<nav class="pcoded-navbar active-lightblue title-lightblue navbar-lightblue brand-lightblue navbar-image-4 menu-item-icon-style2 {{\Cookie::get('sidebar')}}">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            @if(isset($setting) && !empty($setting->logo_path) && file_exists(public_path('uploads/setting/'.$setting->logo_path)))
            <a href="{{ route('supplier.dashboard.index') }}" class="b-brand">
                <img src="{{ asset('uploads/setting/'.$setting->logo_path) }}" alt="logo">
            </a>
            @endif
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>

        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item {{ Request::is('supplier/dashboard*') || Request::is('supplier') ? 'active' : '' }}">
                    <a href="{{ route('supplier.dashboard.index') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-th-large"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('supplier/order*') ? 'active' : '' }}">
                    <a href="{{ route('supplier.order.index') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-file-invoice"></i></span>
                        <span class="pcoded-mtext">Orders</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('supplier/stock*') ? 'active' : '' }}">
                    <a href="{{ route('supplier.stock.index') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-boxes"></i></span>
                        <span class="pcoded-mtext">My Stocks</span>
                    </a>
                </li>

                {{-- Products Section --}}
                <li class="nav-item pcoded-menu-caption">
                    <label>Products</label>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-box"></i></span>
                        <span class="pcoded-mtext">Product</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('supplier/product/category*') ? 'active' : '' }}">
                    <a href="{{ route('supplier.product.category.index') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-tags"></i></span>
                        <span class="pcoded-mtext">Category</span>
                    </a>
                </li>

                <li class="nav-item pcoded-menu-caption">
                    <label>Account Pages</label>
                </li>
                <li class="nav-item {{ Request::is('supplier/profile*') ? 'active' : '' }}">
                    <a href="{{ route('supplier.profile.index') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-user"></i></span>
                        <span class="pcoded-mtext">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('supplier-logout-form').submit();">
                        <span class="pcoded-micon"><i class="fas fa-sign-out-alt"></i></span>
                        <span class="pcoded-mtext">Log out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Categories -->
        <li class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Quản lý danh mục</span>
            </a>
        </li>

        <!-- Nav Item - Products -->
        <li class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.products.index') }}">
                <i class="fas fa-fw fa-box"></i>
                <span>Quản lý sản phẩm</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.variants.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.variants.index') }}">
                <i class="fas fa-fw fa-box"></i>
                <span>Quản lý biến thể</span>
            </a>
        </li>

        <!-- Nav Item - Banners -->
        <li class="nav-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.banners.index') }}">
                <i class="fas fa-fw fa-images"></i>
                <span>Quản lý Banner</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Orders -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Quản lý đơn hàng</span>
            </a>
        </li>

        <!-- Nav Item - Variants -->
        {{-- <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-tags"></i>
                <span>Quản lý biến thể</span>
            </a>
        </li> --}}

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

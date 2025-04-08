<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-mobile-alt me-2 text-primary"></i>
                <span class="fw-bold">PhoneShop</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-th-large me-1"></i> Danh mục
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('home') }}">Tất cả</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('category.products', $category->id) }}">
                                        <i class="fas fa-mobile-alt me-2"></i> {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <form class="d-flex me-3" action="{{route('card')}}" method="GET">
                        <button class="btn btn-outline-primary position-relative" type="submit">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                +
                            </span>
                        </button>
                    </form>

                    @if(isset($orderId) && $orderId)
                        <form class="d-flex me-3" action="{{ route('orders.index') }}" method="GET">
                            <button class="btn btn-outline-primary position-relative" type="submit">
                                <i class="fas fa-clipboard-list"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    +
                                </span>
                            </button>
                        </form>
                    @endif

                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if (Auth::check())
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user-circle me-2"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-2"></i> Đăng nhập
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Search Bar -->
    <div class="search-container">
        <div class="container">
            <form method="GET" class="search-form">
                <div class="search-wrapper">
                    <div class="search-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" name="search" class="search-input" 
                        placeholder="Hôm nay bạn cần gì ở chúng tôi ..." 
                        value="{{ request('search') }}">
                    <button type="submit" class="search-button">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Search Bar Styles */
        .search-container {
            padding: 2rem 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            margin-top: 4rem;
        }

        .search-wrapper {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            background: white;
            border-radius: 50px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .search-wrapper:focus-within {
            box-shadow: 0 4px 20px rgba(13, 110, 253, 0.2);
            transform: translateY(-2px);
        }

        .search-icon {
            padding: 0 1.5rem;
            color: #6c757d;
            font-size: 1.2rem;
        }

        .search-input {
            flex: 1;
            border: none;
            padding: 1rem 0;
            font-size: 1.1rem;
            outline: none;
            color: #333;
        }

        .search-input::placeholder {
            color: #adb5bd;
        }

        .search-button {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-button:hover {
            background: #0b5ed7;
        }

        @media (max-width: 768px) {
            .search-container {
                padding: 1rem 0;
                margin-top: 3.5rem;
            }

            .search-wrapper {
                border-radius: 30px;
            }

            .search-icon {
                padding: 0 1rem;
                font-size: 1rem;
            }

            .search-input {
                padding: 0.8rem 0;
                font-size: 1rem;
            }

            .search-button {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }
        }
    </style>

    <!-- Slideshow -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @forelse($banners as $key => $banner)
                <button type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                    aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}">
                </button>
            @empty
                <!-- Hiển thị banner mặc định nếu không có banner -->
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1">
                </button>
            @endforelse
        </div>
        <div class="carousel-inner">
            @forelse($banners as $key => $banner)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset($banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $banner->title }}</h5>
                        @if ($banner->description)
                            <p>{{ $banner->description }}</p>
                        @endif
                    </div> --}}
                </div>
            @empty
                <!-- Banner mặc định -->
                <div class="carousel-item active">
                    <img src="{{ asset('images/default-banner.jpg') }}" class="d-block w-100" alt="Default Banner">
                </div>
            @endforelse
        </div>
        @if ($banners->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>

    <!-- CSS cho slideshow -->
    <style>
        /* Card sản phẩm */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 280px;
            /* Tăng chiều cao ảnh */
            width: 100%;
            object-fit: contain;
            /* Đổi từ cover sang contain để hiển thị đầy đủ ảnh */
            padding: 10px;
            background: #fff;
            /* Nền trắng để ảnh nổi bật */
            transition: transform 0.3s ease;
        }


        /* Tên sản phẩm */
        .card .fw-bolder {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 10px;
            min-height: 40px;
        }

        nav {
            background-color: cornsilk;
        }


        /* Giá sản phẩm */
        .card-body .text-center {
            font-size: 1.1rem;
            color: #e74c3c;
            font-weight: 600;
        }

        /* Nút thêm vào giỏ */
        .btn-outline-dark {
            border-radius: 25px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }

        .btn-outline-dark:hover {
            background-color: #2c3e50;
            color: white;
            transform: scale(1.05);
        }

        /* Tiêu đề section */
        section h2 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 10px;
        }

        section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: #e74c3c;
        }

        /* Container spacing */
        .container.px-4.px-lg-5.mt-5 {
            padding-top: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-img-top {
                height: 150px;
            }

            .card .fw-bolder {
                font-size: 1rem;
            }
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }

        .carousel-caption h5 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .carousel-caption p {
            font-size: 16px;
        }

        .loc {
            flex-direction: column;
            display: flex;
            align-items: center;
            padding: 20px;
        }

        h4 {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: coral;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
        }

        .fom {
            margin: 30px;
        }

        .fom>input {
            border-radius: 20px;
        }

        .icon {
            font-size: 20px;
            background-color: rgb(31, 30, 30);
        }

        .icon a {
            margin-left: 10px;
            color: white;
            text-decoration: none;
        }
        
        /* Filter Section */
        .filter-section {
            padding: 1rem 0;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .filter-form {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: center;
        }

        .price-input {
            width: 150px;
            padding: 0.5rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s ease;
        }

        .price-input:focus {
            border-color: #0d6efd;
        }

        .filter-button {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-button:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .search-container {
                padding: 1rem 0;
                margin-top: 3.5rem;
            }

            .search-wrapper {
                border-radius: 30px;
            }

            .search-icon {
                padding: 0 1rem;
                font-size: 1rem;
            }

            .search-input {
                padding: 0.8rem 0;
                font-size: 1rem;
            }

            .search-button {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }

            .filter-form {
                flex-direction: column;
                padding: 0 1rem;
            }

            .price-input {
                width: 100%;
            }

            .filter-button {
                width: 100%;
            }
        }
    </style>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" class="filter-form">
            <input type="number" name="min_price" class="price-input" 
                placeholder="Giá tối thiểu" value="{{ request('min_price') }}">
            <input type="number" name="max_price" class="price-input" 
                placeholder="Giá tối đa" value="{{ request('max_price') }}">
            <button type="submit" class="filter-button">
                <i class="fas fa-filter me-2"></i>Lọc
            </button>
        </form>
    </div>

    <!-- Section-->
    <div class="loc">
        {{-- <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="number" name="min_price" class="form-control" placeholder="Giá tối thiểu"
                    value="{{ request('min_price') }}">
                <input type="number" name="max_price" class="form-control" placeholder="Giá tối đa"
                    value="{{ request('max_price') }}">
                <button type="submit" class="btn btn-outline-secondary">Lọc</button>
            </div>
        </form> --}}
    </div>

    <section class="py-0">
        <h4>Sản phẩm của Shop</h4>
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="{{ route('products.show', $product->id) }}">
                                <img class="card-img-top" src="{{ asset($product->image) }}"
                                    alt="{{ $product->name }}" />
                            </a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $product->name }}
                                        </a>
                                    </h5>
                                    <!-- Product price-->
                                    Từ {{ number_format($product->price) }} VNĐ
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto"
                                        href="{{ route('products.show', $product->id) }}">
                                        <i class="bi-cart-plus-fill me-1"></i>
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer-->
    {{-- <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Vandai2k5</p>
        </div>
    </footer> --}}

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Notification System -->
    <div id="notification" class="position-fixed" style="z-index: 9999; top: 80px; right: 20px;">
        <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>
                    <span id="notification-message"></span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        // Function to show notification
        function showNotification(message) {
            const notification = document.getElementById('notification');
            const toast = notification.querySelector('.toast');
            const messageElement = document.getElementById('notification-message');
            
            messageElement.textContent = message;
            
            // Show the notification
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            // Automatically hide after 3 seconds
            setTimeout(() => {
                bsToast.hide();
            }, 3000);
        }

        // Check for login success message in session
        @if(session('success'))
            showNotification('{{ session('success') }}');
        @endif
    </script>
</body>
@include('clients.footer')

</html>

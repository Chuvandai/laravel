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
    {{-- @include('clients.header') --}}
    <nav class="navbar navbar-expand-lg navbar-white bg-dark">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand text-light  " href="{{ route('home') }}">Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item "><a class="nav-link active text-light" aria-current="page"
                            href="{{ route('home') }}">Trang
                            chủ</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Danh mục</a>
                        <ul class="dropdown-menu text-light " aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item " href="{{ route('home') }}">Tất cả</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item" href="#">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <form class="d-flex"  action="{{route('card')}}" method="GET">
                    <button class="btn btn-outline-dark text-light" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Giỏ hàng
                        <span class="badge bg-dark text-white ms-1 rounded-pill">+</span>
                    </button>
                </form>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <div class="icon">
                    @if (Auth::check())
                        <a href="{{ route('profile') }}">
                            <i class="fa-solid fa-user"></i> Profile
                        </a>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-sign-out-alt"></i> Đăng xuất
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <i class="fa-solid fa-circle-user"></i> Đăng nhập
                        </a>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                </div>
            </div>
        </div>
    </nav>
    <div class="fom">
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control w-auto"
                    placeholder="Hôm nay bạn cần tìm kiếm gì nào hãy nhập vào đây ne !!!!"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
            </div>
        </form>
    </div>
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
        
        
    </style>

    <!-- Header-->
    {{-- <header class="bg-dark py-0">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display  fw-bolder">Shop Online</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Mua sắm online dễ dàng</p>
                </div>
            </div>
        </header> --}}

    <!-- Section-->
    <div class="loc">
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="number" name="min_price" class="form-control" placeholder="Giá tối thiểu"
                    value="{{ request('min_price') }}">
                <input type="number" name="max_price" class="form-control" placeholder="Giá tối đa"
                    value="{{ request('max_price') }}">
                <button type="submit" class="btn btn-outline-secondary">Lọc</button>
            </div>
        </form>
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
</body>
@include('clients.footer')

</html>

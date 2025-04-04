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
        
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-white bg-dark">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand text-light  " href="{{ route('home') }}">Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item "><a class="nav-link active text-light" aria-current="page" href="{{ route('home') }}">Trang
                                chủ</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Danh mục</a>
                            <ul class="dropdown-menu text-light " aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item " href="{{ route('home') }}">Tất cả</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                {{-- @foreach ($categories as $category)
                                    <li><a class="dropdown-item" href="#">{{ $category->name }}</a></li>
                                @endforeach --}}
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark text-light" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Giỏ hàng
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </body>
</html>

@include('clients.header')

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop Online</h1>
            <p class="lead fw-normal text-white-50 mb-0">Mua sắm online dễ dàng</p>
        </div>
    </div>
</header>

<!-- Section-->
<section class="py-0">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($products as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <a href="{{ route('products.show', $product->id) }}">
                        <img class="card-img-top" src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                    </a>
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">
                                <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
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
                            <a class="btn btn-outline-dark mt-auto" href="{{ route('products.show', $product->id) }}">
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

@include('clients.footer')

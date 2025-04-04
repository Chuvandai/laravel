@include('clients.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid product-detail-container">

    <div class="row">
        <!-- Cột trái cho ảnh sản phẩm -->
        <div class="col-md-7">
            <div class="product-gallery">
                <!-- Ảnh chính -->
                <div class="main-image-container">
                    <button class="nav-btn prev-btn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <img id="mainImage" src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                    <button class="nav-btn next-btn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <h3>Sản phẩm liên quan</h3>
                <div class="related-products d-flex justify-center mx-2 ">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="product">
                            <a href="{{ route('products.show', $relatedProduct->id) }}">
                                <img src="{{ asset($relatedProduct->image) }}" class="img-fluid">
                                <h5>{{ $relatedProduct->name }}</h5>
                                <p>{{ number_format($relatedProduct->price) }} VND</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Cột phải cho thông tin sản phẩm -->
        <div class="col-md-5">
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>

                <!-- Khu vực chọn địa điểm -->
                <div class="location-selector mb-4">
                    <span class="location-label">Giá và khuyến mãi tại:</span>
                    <select class="form-select">
                        <option>Hồ Chí Minh</option>
                        <option>Hà Nội</option>
                        <option>Đà Nẵng</option>
                    </select>
                </div>

                <!-- Phần chọn biến thể -->
                <div class="variants-section">
                    <!-- Dung lượng -->
                    <div class="variant-group mb-4">
                        <label class="variant-label">Dung lượng</label>
                        <div class="variant-options">
                            @foreach ($product->variants->pluck('storage')->unique() as $storage)
                                <button type="button" class="variant-btn storage-select"
                                    data-storage="{{ $storage }}">
                                    {{ $storage }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Màu sắc -->
                    <div class="variant-group mb-4">
                        <label class="variant-label">Màu sắc</label>
                        <div class="variant-options">
                            @foreach ($product->variants->pluck('color')->unique() as $color)
                                <button type="button" class="variant-btn color-select"
                                    data-color="{{ $color }}">
                                    <span class="color-circle" style="background-color: {{ $color }}"></span>
                                    {{ $color }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Giá và khuyến mãi -->
                    <div class="price-section">
                        <div class="current-price">
                            <span class="price-label">Online Giá Rẻ Quá</span>
                            <span class="price-value">{{ number_format($product->price) }}₫</span>
                        </div>
                        <div class="original-price">
                            <span class="price-value text-decoration-line-through">
                                {{ number_format($product->price * 1.12) }}₫
                            </span>
                            <span class="discount-badge">-12%</span>
                        </div>
                    </div>

                    <!-- Khuyến mãi -->
                    <div class="promotion-section mt-4">
                        <div class="promotion-header">
                            Khuyến mãi trị giá 500.000₫
                        </div>
                        <div class="promotion-content">
                            <ul class="promotion-list">
                                <li>Phiếu mua hàng AirPods, Apple Watch, Macbook mệnh giá 500.000₫</li>
                                <li>Phiếu mua hàng phụ kiện mệnh giá 500.000₫</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Nút mua hàng -->
                    <div class="purchase-buttons mt-4">
                        <button class="btn btn-primary btn-lg w-100 mb-3" id="buyNow">
                            MUA NGAY
                        </button>
                        <button class="btn btn-outline-primary btn-lg w-100" id="addToCart">
                            THÊM VÀO GIỎ HÀNG
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .product-detail-container {
        padding: 30px;
        background: #f5f5f7;
    }

    /* Gallery styles */
    .main-image-container {
        position: relative;
        background: white;
        padding: 20px;
        border-radius: 20px;
        text-align: center;
    }

    .title {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px;
    }

    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.8);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }

    .thumbnail-gallery {
        overflow-x: auto;
        white-space: nowrap;
    }

    .thumbnails-container {
        display: flex;
        gap: 10px;
        justify-content: center;
        align-items: center
    }

    .thumbnail-item {
        flex: 0 0 100px;
        height: 100px;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .thumbnail-item.active {
        border-color: #0066cc;
    }

    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Product info styles */
    .product-info {
        background: white;
        padding: 30px;
        border-radius: 20px;
    }

    .product-title {
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .variant-label {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .variant-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .variant-btn {
        padding: 10px 20px;
        border: 2px solid #ddd;
        border-radius: 10px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .variant-btn:hover,
    .variant-btn.active {
        border-color: #0066cc;
        background: #f0f7ff;
    }

    .color-circle {
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-right: 8px;
        vertical-align: middle;
    }

    /* Price styles */
    .price-section {
        background: #f5f5f7;
        padding: 20px;
        border-radius: 10px;
        margin: 20px 0;
    }

    .current-price {
        font-size: 1.8rem;
        font-weight: 700;
        color: #e74c3c;
    }

    .price-label {
        display: block;
        font-size: 1rem;
        color: #666;
        margin-bottom: 5px;
    }

    .discount-badge {
        background: #e74c3c;
        color: white;
        padding: 2px 8px;
        border-radius: 4px;
        margin-left: 10px;
    }

    /* Promotion styles */
    .promotion-section {
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    .promotion-header {
        background: #f8f9fa;
        padding: 15px;
        border-bottom: 1px solid #ddd;
        font-weight: 600;
    }

    .promotion-content {
        padding: 15px;
    }

    .promotion-list {
        padding-left: 20px;
        margin: 0;
    }

    .promotion-list li {
        margin-bottom: 10px;
    }

    /* Button styles */
    .btn-lg {
        padding: 15px 30px;
        font-weight: 600;
        border-radius: 10px;
    }

    .btn-primary {
        background: #0066cc;
        border: none;
    }

    .btn-outline-primary {
        border-color: #0066cc;
        color: #0066cc;
    }

    @media (max-width: 768px) {
        .product-detail-container {
            padding: 15px;
        }

        .product-title {
            font-size: 1.8rem;
        }

        .variant-btn {
            padding: 8px 15px;
        }
    }

    .product a {
        text-decoration: none;
        padding: 20px 15px;
        color: rgb(127, 156, 213);
        text-align: center;
    }
</style>

<script>
    // document.getElementById('addToCart').addEventListener('click', function() {
    //     let selectedStorage = document.querySelector('.storage-select.active');
    //     let selectedColor = document.querySelector('.color-select.active');

    //     if (!selectedStorage || !selectedColor) {
    //         alert('Vui lòng chọn dung lượng và màu sắc!');
    //         return;
    //     }

    //     let productId = "{{ $product->id }}";
    //     let storage = selectedStorage.dataset.storage;
    //     let color = selectedColor.dataset.color;
    //     let quantity = 1; // Nếu có input số lượng thì lấy giá trị từ đó

    //     fetch("{{ route('card') }}", {
    //             method: "POST",
    //             headers: {
    //                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
    //                     'content'),
    //                 "Content-Type": "application/json"
    //             },
    //             body: JSON.stringify({
    //                 product_id: productId,
    //                 storage: storage,
    //                 color: color,
    //                 quantity: quantity
    //             })
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.success) {
    //                 alert("🛒 Thêm vào giỏ hàng thành công!");
    //                 document.getElementById('cart-count').textContent = data.cart_count;
    //                 window.location.href = "{{ route('card') }}"; // Chuyển hướng đến trang giỏ hàng
    //             } else {
    //                 alert("⚠️ Lỗi: " + data.message);
    //             }
    //         })
    //         .catch(error => {
    //             alert("❌ Đã xảy ra lỗi, vui lòng thử lại!");
    //             console.error("Lỗi:", error);
    //         });
    // });
    document.getElementById('addToCart').addEventListener('click', function() {
    let selectedStorage = document.querySelector('.storage-select.active');
    let selectedColor = document.querySelector('.color-select.active');

    if (!selectedStorage || !selectedColor) {
        alert('Vui lòng chọn dung lượng và màu sắc!');
        return;
    }

    let productId = "{{ $product->id }}";
    let storage = selectedStorage.dataset.storage;
    let color = selectedColor.dataset.color;
    let quantity = 1;

    let btn = this;
    btn.disabled = true; // Vô hiệu hóa nút để tránh nhấn nhiều lần

    fetch("{{ route('card') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                product_id: productId,
                storage: storage,
                color: color,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("🛒 Thêm vào giỏ hàng thành công!");
                // document.getElementById('cart-count').textContent = data.cart_count;
                window.location.href = "{{ route('card') }}";
            } else {
                alert("⚠️ Lỗi: " + data.message);
            }
        })
        .catch(error => {
            alert("❌ Đã xảy ra lỗi, vui lòng thử lại!");
            console.error("Lỗi:", error);
        })
        .finally(() => {
            btn.disabled = false; // Bật lại nút sau khi xử lý xong
        });
});

    // Xử lý chọn biến thể
    document.querySelectorAll('.variant-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const parent = this.closest('.variant-options');
            parent.querySelectorAll('.variant-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            updatePrice();
        });
    });

    // Xử lý cập nhật giá khi chọn biến thể
    let variants = @json($product->variants);

    function updatePrice() {
        let storageBtn = document.querySelector('.storage-select.active');
        let colorBtn = document.querySelector('.color-select.active');

        if (storageBtn && colorBtn) {
            let storage = storageBtn.dataset.storage;
            let color = colorBtn.dataset.color;

            let selectedVariant = variants.find(v => v.storage === storage && v.color === color);

            if (selectedVariant) {
                document.querySelector('.current-price .price-value').textContent = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(selectedVariant.price);
            }
        }
    }
</script>


@include('clients.footer')

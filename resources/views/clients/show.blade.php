@include('clients.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="user-logged-in" content="{{ Auth::check() ? 'true' : 'false' }}">

<div class="container-fluid product-detail-container">
    <div class="row">
        <!-- Left Column - Product Images -->
        <div class="col-md-6">
            <div class="product-gallery">
                <div class="main-image-container">
                    <button class="nav-btn prev-btn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <img id="mainImage" src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                    <button class="nav-btn next-btn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                
                <!-- Related Products -->
                <div class="related-products-section mt-4">
                    <h4 class="section-title">Sản phẩm tương tự</h4>
                    <div class="related-products-container">
                        <div class="related-products-slider">
                            @foreach ($relatedProducts as $relatedProduct)
                                <div class="related-product-card">
                                    <a href="{{ route('products.show', $relatedProduct->id) }}" class="text-decoration-none">
                                        <div class="related-product-image">
                                            <img src="{{ asset($relatedProduct->image) }}" alt="{{ $relatedProduct->name }}">
                                        </div>
                                        <div class="related-product-info">
                                            <h5>{{ $relatedProduct->name }}</h5>
                                            <p class="price">{{ number_format($relatedProduct->price) }} VND</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <button class="scroll-btn scroll-left">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="scroll-btn scroll-right">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Product Info -->
        <div class="col-md-6">
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>
                
                <!-- Price Section -->
                <div class="price-section">
                    <div class="current-price">
                        <span class="price-label">Giá bán</span>
                        <span class="price-value">{{ number_format($product->price) }}₫</span>
                    </div>
                    <div class="original-price">
                        <span class="price-value text-decoration-line-through">
                            {{ number_format($product->price * 1.12) }}₫
                        </span>
                        <span class="discount-badge">-12%</span>
                    </div>
                </div>

                <!-- Variants Section -->
                <div class="variants-section">
                    <!-- Storage Options -->
                    <div class="variant-group">
                        <label class="variant-label">Dung lượng</label>
                        <div class="variant-options">
                            @foreach ($product->variants->pluck('storage')->unique() as $storage)
                                <button type="button" class="variant-btn storage-select" data-storage="{{ $storage }}">
                                    {{ $storage }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Color Options -->
                    <div class="variant-group">
                        <label class="variant-label">Màu sắc</label>
                        <div class="variant-options">
                            @foreach ($product->variants->pluck('color')->unique() as $color)
                                <button type="button" class="variant-btn color-select" data-color="{{ $color }}">
                                    <span class="color-circle" style="background-color: {{ $color }}"></span>
                                    {{ $color }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Promotion Section -->
                <div class="promotion-section">
                    <div class="promotion-header">
                        <i class="fas fa-gift"></i>
                        <span>Khuyến mãi đặc biệt</span>
                    </div>
                    <div class="promotion-content">
                        <ul class="promotion-list">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Phiếu mua hàng AirPods, Apple Watch, Macbook trị giá 500.000₫</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Phiếu mua hàng phụ kiện trị giá 500.000₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn btn-primary btn-lg w-100 mb-3" id="buyNow">
                        <i class="fas fa-shopping-bag me-2"></i>
                        MUA NGAY
                    </button>
                    <button class="btn btn-outline-primary btn-lg w-100" id="addToCart">
                        <i class="fas fa-cart-plus me-2"></i>
                        THÊM VÀO GIỎ HÀNG
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="reviews-section mt-5">
        <div class="reviews-header">
            <h3>Đánh giá sản phẩm</h3>
            <div class="rating-summary">
                <div class="average-rating">
                    <h2>{{ number_format($product->average_rating, 1) }}</h2>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $product->average_rating ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                    </div>
                    <p>{{ $product->total_reviews }} đánh giá</p>
                </div>
            </div>
        </div>

        <!-- Review Form -->
        @if(Auth::check())
            @if($product->hasUserPurchased(Auth::id()) || true)
                <div class="review-form">
                    <h4>Viết đánh giá của bạn</h4>
                    <form action="{{ route('products.review', $product->id) }}" method="POST">
                        @csrf
                        <div class="rating-input">
                            <label>Đánh giá:</label>
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="far fa-star" data-rating="{{ $i }}"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating" value="0">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="3" placeholder="Viết đánh giá của bạn..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                    </form>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Bạn cần mua sản phẩm này trước khi đánh giá.
                </div>
            @endif
        @else
            <div class="alert alert-info">
                <a href="{{ route('login') }}" class="alert-link">Đăng nhập</a> để viết đánh giá
            </div>
        @endif

        <!-- Reviews List -->
        <div class="reviews-list">
            @foreach($product->reviews as $review)
                <div class="review-item">
                    <div class="review-header">
                        <div class="user-info">
                            <div class="user-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="user-details">
                                <h5>{{ $review->user->name }}</h5>
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="review-content">
                        <p>{{ $review->comment }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .product-detail-container {
        padding: 30px;
        background: #f8f9fa;
    }

    /* Gallery Styles */
    .product-gallery {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .main-image-container {
        position: relative;
        text-align: center;
        margin-bottom: 20px;
    }

    .main-image-container img {
        max-height: 500px;
        object-fit: contain;
    }

    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.8);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .nav-btn:hover {
        background: rgba(255,255,255,1);
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }

    /* Related Products */
    .related-products-section {
        margin-top: 30px;
        position: relative;
    }

    .section-title {
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: #333;
    }

    .related-products-container {
        position: relative;
        padding: 0 40px;
    }

    .related-products-slider {
        display: flex;
        gap: 15px;
        overflow-x: hidden;
        scroll-behavior: smooth;
        padding: 10px 0;
    }

    .related-product-card {
        flex: 0 0 200px;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }

    .related-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        border-color: #0d6efd;
    }

    .related-product-image {
        height: 150px;
        overflow: hidden;
        border-bottom: 1px solid #e0e0e0;
    }

    .related-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .related-product-card:hover .related-product-image img {
        transform: scale(1.05);
    }

    .related-product-info {
        padding: 15px;
    }

    .related-product-info h5 {
        font-size: 1rem;
        margin-bottom: 5px;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .related-product-info .price {
        color: #e74c3c;
        font-weight: 600;
    }

    .scroll-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 2;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .scroll-btn:hover {
        background: #f8f9fa;
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .scroll-left {
        left: 0;
    }

    .scroll-right {
        right: 0;
    }

    /* Product Info Styles */
    .product-info {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .product-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    /* Price Section */
    .price-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .current-price {
        display: flex;
        align-items: baseline;
        gap: 10px;
    }

    .price-label {
        color: #666;
        font-size: 1rem;
    }

    .price-value {
        font-size: 2rem;
        font-weight: 700;
        color: #e74c3c;
    }

    .original-price {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 5px;
    }

    .discount-badge {
        background: #e74c3c;
        color: white;
        padding: 3px 10px;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    /* Variants Section */
    .variant-group {
        margin-bottom: 25px;
    }

    .variant-label {
        display: block;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .variant-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .variant-btn {
        padding: 10px 20px;
        border: 2px solid #ddd;
        border-radius: 8px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .variant-btn:hover,
    .variant-btn.active {
        border-color: #0d6efd;
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

    /* Promotion Section */
    .promotion-section {
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .promotion-header {
        background: #f8f9fa;
        padding: 15px;
        border-bottom: 1px solid #ddd;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .promotion-header i {
        color: #e74c3c;
    }

    .promotion-content {
        padding: 15px;
    }

    .promotion-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .promotion-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .promotion-list li i {
        color: #28a745;
    }

    /* Action Buttons */
    .action-buttons {
        margin-top: 30px;
    }

    .btn-primary {
        background: #0d6efd;
        border: none;
        padding: 12px 24px;
    }

    .btn-outline-primary {
        border-color: #0d6efd;
        color: #0d6efd;
    }

    /* Reviews Section */
    .reviews-section {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .reviews-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .rating-summary {
        text-align: center;
    }

    .average-rating h2 {
        font-size: 3rem;
        color: #333;
        margin-bottom: 5px;
    }

    .stars {
        color: #ffc107;
        font-size: 1.2rem;
    }

    .review-form {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .rating-input {
        margin-bottom: 20px;
    }

    .rating-input .stars {
        display: inline-block;
        margin-left: 10px;
    }

    .rating-input .stars i {
        cursor: pointer;
        margin-right: 5px;
    }

    .reviews-list {
        margin-top: 30px;
    }

    .review-item {
        border-bottom: 1px solid #eee;
        padding: 20px 0;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-avatar {
        font-size: 2rem;
        color: #6c757d;
    }

    .user-details h5 {
        margin-bottom: 5px;
        color: #333;
    }

    .review-date {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .review-content {
        color: #333;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .product-detail-container {
            padding: 15px;
        }

        .product-title {
            font-size: 1.5rem;
        }

        .price-value {
            font-size: 1.5rem;
        }

        .variant-btn {
            padding: 8px 15px;
        }

        .reviews-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .rating-summary {
            margin-top: 20px;
        }

        .related-products-container {
            padding: 0 30px;
        }

        .related-product-card {
            flex: 0 0 160px;
        }

        .related-product-image {
            height: 120px;
        }
    }
</style>

<script>
    // Existing JavaScript code remains the same
    document.getElementById('addToCart').addEventListener('click', function() {
        let selectedStorage = document.querySelector('.storage-select.active');
        let selectedColor = document.querySelector('.color-select.active');
        let isLoggedIn = document.querySelector('meta[name="user-logged-in"]').getAttribute('content') === 'true';

        if (!isLoggedIn) {
            alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!');
            window.location.href = "{{ route('login') }}";
            return;
        }

        if (!selectedStorage || !selectedColor) {
            alert('Vui lòng chọn dung lượng và màu sắc!');
            return;
        }

        let productId = "{{ $product->id }}";
        let storage = selectedStorage.dataset.storage;
        let color = selectedColor.dataset.color;
        let quantity = 1;

        let btn = this;
        btn.disabled = true;

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
                showNotification("🛒 Thêm vào giỏ hàng thành công!");
                window.location.href = "{{ route('card') }}";
            } else {
                showNotification("⚠️ Lỗi: " + data.message);
            }
        })
        .catch(error => {
            showNotification("❌ Đã xảy ra lỗi, vui lòng thử lại!");
            console.error("Lỗi:", error);
        })
        .finally(() => {
            btn.disabled = false;
        });
    });

    // Variant selection
    document.querySelectorAll('.variant-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const parent = this.closest('.variant-options');
            parent.querySelectorAll('.variant-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            updatePrice();
        });
    });

    // Price update
    let variants = @json($product->variants);

    function updatePrice() {
        let storageBtn = document.querySelector('.storage-select.active');
        let colorBtn = document.querySelector('.color-select.active');

        if (storageBtn && colorBtn) {
            let storage = storageBtn.dataset.storage;
            let color = colorBtn.dataset.color;

            let selectedVariant = variants.find(v => v.storage === storage && v.color === color);

            if (selectedVariant) {
                document.querySelector('.current-price .price-value').textContent = 
                    new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(selectedVariant.price);
            }
        }
    }

    // Rating functionality
    document.querySelectorAll('.rating-input .stars i').forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.dataset.rating;
            const stars = this.parentElement.querySelectorAll('i');
            
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.classList.remove('far');
                    s.classList.add('fas');
                } else {
                    s.classList.remove('fas');
                    s.classList.add('far');
                }
            });
            
            document.getElementById('rating').value = rating;
        });
    });

    // Review form submission
    document.querySelector('.review-form form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                rating: document.getElementById('rating').value,
                comment: form.querySelector('textarea[name="comment"]').value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message);
                location.reload();
            } else {
                showNotification(data.message);
            }
        })
        .catch(error => {
            showNotification('Có lỗi xảy ra, vui lòng thử lại sau.');
            console.error('Error:', error);
        })
        .finally(() => {
            submitButton.disabled = false;
        });
    });

    // Notification function
    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-info-circle"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Auto-scroll functionality for related products
    const slider = document.querySelector('.related-products-slider');
    const scrollLeftBtn = document.querySelector('.scroll-left');
    const scrollRightBtn = document.querySelector('.scroll-right');
    let autoScrollInterval;

    function startAutoScroll() {
        autoScrollInterval = setInterval(() => {
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
                slider.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                slider.scrollBy({ left: 200, behavior: 'smooth' });
            }
        }, 3000);
    }

    function stopAutoScroll() {
        clearInterval(autoScrollInterval);
    }

    // Start auto-scroll when page loads
    startAutoScroll();

    // Pause auto-scroll on hover
    slider.addEventListener('mouseenter', stopAutoScroll);
    slider.addEventListener('mouseleave', startAutoScroll);

    // Manual scroll buttons
    scrollLeftBtn.addEventListener('click', () => {
        slider.scrollBy({ left: -200, behavior: 'smooth' });
    });

    scrollRightBtn.addEventListener('click', () => {
        slider.scrollBy({ left: 200, behavior: 'smooth' });
    });

    // Hide scroll buttons when at the start/end
    function updateScrollButtons() {
        scrollLeftBtn.style.display = slider.scrollLeft === 0 ? 'none' : 'flex';
        scrollRightBtn.style.display = slider.scrollLeft + slider.clientWidth >= slider.scrollWidth ? 'none' : 'flex';
    }

    slider.addEventListener('scroll', updateScrollButtons);
    updateScrollButtons();
</script>

<style>
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        animation: slideIn 0.3s ease-out;
    }

    .notification-content {
        background: #fff;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .notification i {
        color: #28a745;
        font-size: 1.2rem;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>

@include('clients.footer')

@include('clients.header')

<div class="category-products-container">
    <!-- Category Header -->
    <div class="category-header">
        <div class="container">
            <div class="category-info">
                <h1 class="category-title">
                    <i class="fas fa-mobile-alt me-2"></i>
                    {{ $category->name }}
                </h1>
                <p class="category-description">
                    {{ $category->description ?? 'Khám phá các sản phẩm ' . $category->name . ' mới nhất' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="container py-5">
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="product-card">
                        <div class="product-image">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">
                                <a href="{{ route('products.show', $product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <div class="product-price">
                                {{ number_format($product->price) }} VND
                            </div>
                            <div class="product-actions">
                                <a href="{{ route('products.show', $product->id) }}" class="btn-view-details">
                                    <i class="fas fa-eye me-2"></i>Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-container mt-5">
            {{ $products->links() }}
        </div>
    </div>
</div>

<style>
.category-products-container {
    padding-top: 4rem;
}

.category-header {
    background: linear-gradient(135deg, #6c5ce7, #a29bfe);
    color: white;
    padding: 3rem 0;
    margin-bottom: 2rem;
}

.category-info {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.category-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.category-description {
    font-size: 1.1rem;
    opacity: 0.9;
}

.product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.product-image {
    padding: 1rem;
    background: #f8f9fa;
    text-align: center;
}

.product-image img {
    width: 100%;
    height: 200px;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-info {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-name {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.product-name a {
    color: #333;
    text-decoration: none;
}

.product-name a:hover {
    color: #6c5ce7;
}

.product-price {
    font-size: 1.2rem;
    color: #e74c3c;
    font-weight: 600;
    margin-bottom: 1rem;
}

.product-actions {
    margin-top: auto;
}

.btn-view-details {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    background: #6c5ce7;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-view-details:hover {
    background: #5b4bc4;
    color: white;
    transform: translateY(-2px);
}

.pagination-container {
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    gap: 0.5rem;
}

.pagination .page-item .page-link {
    border-radius: 8px;
    padding: 0.5rem 1rem;
    color: #6c5ce7;
    border: 1px solid #6c5ce7;
}

.pagination .page-item.active .page-link {
    background: #6c5ce7;
    border-color: #6c5ce7;
    color: white;
}

.pagination .page-item .page-link:hover {
    background: #f8f9fa;
}

@media (max-width: 768px) {
    .category-header {
        padding: 2rem 0;
    }

    .category-title {
        font-size: 2rem;
    }

    .product-image img {
        height: 150px;
    }
}
</style>

@include('clients.footer') 
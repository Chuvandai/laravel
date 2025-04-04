<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Liên kết với orders
            $table->unsignedBigInteger('product_id'); // Liên kết với sản phẩm
            $table->unsignedBigInteger('variant_id')->nullable(); // Nếu có biến thể
            $table->integer('so_luong'); // Số lượng
            $table->decimal('don_gia', 12, 2); // Đơn giá của sản phẩm
            $table->decimal('thanh_tien', 12, 2); // Tổng tiền cho sản phẩm
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('CASCADE');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

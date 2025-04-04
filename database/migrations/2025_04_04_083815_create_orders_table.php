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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Liên kết với người dùng
            $table->string('ho_va_ten');
            $table->string('dia_chi');
            $table->string('so_dien_thoai');
            $table->enum('trang_thai', ['Chờ xử lý', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao', 'Hủy'])->default('Chờ xử lý');
            $table->integer('tong_tien'); // Tổng tiền của đơn hàng
            $table->string('phuong_thuc_thanh_toan');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

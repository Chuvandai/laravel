<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trang_thai',
        'tong_tien',
        'phuong_thuc_thanh_toan'
    ];

    // Mối quan hệ với bảng OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    // Mối quan hệ với bảng User (nếu có)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

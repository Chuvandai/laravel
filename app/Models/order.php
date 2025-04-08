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

    public function getStatusColor()
    {
        switch ($this->trang_thai) {
            case 'Chờ xử lý':
                return 'warning';
            case 'Đã xác nhận':
                return 'info';
            case 'Đang giao hàng':
                return 'primary';
            case 'Đã giao':
                return 'success';
            case 'Hủy':
                return 'danger';
            default:
                return 'secondary';
        }
    }

    public function getStatusText()
    {
        switch ($this->trang_thai) {
            case 'Chờ xử lý':
                return 'Chờ xử lý';
            case 'Đã xác nhận':
                return 'Đã xác nhận';
            case 'Đang giao hàng':
                return 'Đang giao hàng';
            case 'Đã giao':
                return 'Đã giao';
            case 'Hủy':
                return 'Đã hủy';
            default:
                return $this->trang_thai;
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners'; // Chỉ định tên bảng
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'image',
        'status'
    ];

    // Accessor để format trạng thái
    public function getStatusTextAttribute()
    {
        return $this->status == 0 ? 'Hiển thị' : 'Ẩn';
    }

    public function getStatusBadgeAttribute()
    {
        return $this->status == 0 
            ? '<span class="badge badge-success">Hiển thị</span>'
            : '<span class="badge badge-danger">Ẩn</span>';
    }

    // Scope để lọc banner đang hiển thị
    public function scopeActive($query)
    {
        return $query->where('status', 0);
    }

    // Scope để lọc banner đang ẩn
    public function scopeInactive($query)
    {
        return $query->where('status', 1);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'image',
        'category_id',
        'status'
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
    public function getTotalReviewsAttribute()
    {
        return $this->reviews()->count();
    }
    public function getRatingCountsAttribute()
    {
        return $this->reviews()
            ->selectRaw('rating, count(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details', 'product_id', 'order_id')
            ->withPivot('so_luong', 'don_gia', 'thanh_tien');
    }
    public function hasUserPurchased($userId)
    {
        return OrderDetail::where('product_id', $this->id)
            ->whereHas('order', function($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->where('trang_thai', 'Đã giao');
            })
            ->exists();
    }
}
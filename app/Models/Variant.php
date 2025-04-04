<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $table = 'variants';
    public $timestamps = false;
    protected $fillable = [
        'product_id', 
        'storage', 
        'color', 
        'price', 
        'stock'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    //
}

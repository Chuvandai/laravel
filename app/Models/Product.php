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
}
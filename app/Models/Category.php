<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'status'
    ];
    public function product(){
        return $this->hasMany(Product::class);
    }
}
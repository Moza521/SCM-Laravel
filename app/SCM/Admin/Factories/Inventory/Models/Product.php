<?php

namespace App\SCM\Admin\Factories\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\SCM\Admin\Shops\Models\Sales;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_price',
        'category_id',
        'quantity',
        'active'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function color()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function size()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
}

<?php

namespace App\SCM\Admin\Factories\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'length',
        'width',
        'height',
        'product_id',
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}

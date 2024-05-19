<?php

namespace App\SCM\Admin\Shops\Models;

use App\SCM\Admin\Manufactory\Inventory\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'shop_id'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\SCM\Admin\Deliveries\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\SCM\Admin\Manufactory\Inventory\Models\Product;

class DeliveryProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'delivery_id',
    ];

    public function deriver()
    {
        return $this->hasOne(Delivery::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}

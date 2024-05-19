<?php

namespace App\SCM\Admin\Deliveries\Repositories;

use App\SCM\Admin\Deliveries\Models\DeliveryProduct;
use App\SCM\Admin\Manufactory\Inventory\Models\Product;
use App\SCM\Admin\Deliveries\Models\Delivery;
use App\SCM\Base\Repositories\AbstractRepository;

class DeliveryProductRepository extends AbstractRepository
{
    public function __construct(DeliveryProduct $deliveryProduct)
    {
        $this->setModel($deliveryProduct);
    }

    public function store($delivery_id, $product_id)
    {
        Delivery::findOrFail($delivery_id);
        Product::findOrFail($product_id);
        $deliveryProduct = new DeliveryProduct();
        $deliveryProduct->delivery_id = $delivery_id;
        $deliveryProduct->product_id = $product_id;

        $deliveryProduct->save();
        return $deliveryProduct;
    }

    public function updateProducts($product_id)
    {
        Product::findOrFail($product_id);
        $deliveryProduct = new DeliveryProduct();
        $deliveryProduct->product_id = $product_id;

        $deliveryProduct->save();
        return $deliveryProduct;
    }
}

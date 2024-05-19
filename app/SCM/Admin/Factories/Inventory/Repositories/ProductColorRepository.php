<?php

namespace App\SCM\Admin\Factories\Inventory\Repositories;

use App\SCM\Admin\Factories\Inventory\Models\Product;
use Illuminate\Http\Request;
use App\SCM\Base\Repositories\AbstractRepository;
use App\SCM\Admin\Factories\Inventory\Models\ProductColor;

class ProductColorRepository extends AbstractRepository
{
    public function __construct(ProductColor $productColor)
    {
        $this->setModel($productColor);
    }

    public function index($product_id)
    {
        Product::findOrFail($product_id);

        return productColor::where('product_id', $product_id)->get();
    }

    public function store(Request $request, $product_id)
    {
        Product::findOrFail($product_id);
        $productColor = new ProductColor();
        $productColor->color = $request->get('color');
        $productColor->product_id = $product_id;

        $productColor->save();
        return $productColor;
    }
}

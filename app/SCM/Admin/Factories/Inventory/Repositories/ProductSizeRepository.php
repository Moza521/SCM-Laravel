<?php

namespace App\SCM\Admin\Factories\Inventory\Repositories;

use App\SCM\Admin\Factories\Inventory\Models\Product;
use App\SCM\Admin\Factories\Inventory\Models\ProductSize;
use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Http\Request;

class ProductSizeRepository extends AbstractRepository
{
    public function __construct(ProductSize $productSize)
    {
        $this->setModel($productSize);
    }

    public function index($product_id)
    {
        Product::findOrFail($product_id);

        return ProductSize::where('product_id', $product_id)->get();
    }

    public function store(Request $request, $product_id)
    {
        Product::findOrFail($product_id);
        $productSize = new ProductSize();
        $productSize->length = $request->get('length');
        $productSize->width = $request->get('width');
        $productSize->height = $request->get('height');
        $productSize->product_id = $product_id;

        $productSize->save();
        return $productSize;
    }
}

<?php

namespace App\Http\Controllers\Admin\Factories\Inventory\Products;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Factories\Inventory\Repositories\ProductSizeRepository;
use App\SCM\Admin\Factories\Inventory\Requests\CreateProductSize;

class ProductSizeController extends Controller
{
    private ProductSizeRepository $productSizeRepository;

    public function __construct(ProductSizeRepository $productSizeRepository)
    {
        $this->productSizeRepository = $productSizeRepository;
    }

    public function index($shop_product_id)
    {
        return $this->productSizeRepository->index($shop_product_id);
    }

    public function store(CreateProductSize $request, $shop_product_id)
    {
        return $this->productSizeRepository->store($request, $shop_product_id);
    }

    public function destroy($id)
    {
        return $this->productSizeRepository->delete($id);
    }
}

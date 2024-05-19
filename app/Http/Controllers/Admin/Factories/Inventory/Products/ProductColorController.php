<?php

namespace App\Http\Controllers\Admin\Factories\Inventory\Products;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Factories\Inventory\Repositories\ProductColorRepository;
use App\SCM\Admin\Factories\Inventory\Requests\CreateProductColor;

class ProductColorController extends Controller
{
    private ProductColorRepository $productColorRepository;

    public function __construct(ProductColorRepository $productColorRepository)
    {
        $this->productColorRepository = $productColorRepository;
    }

    public function index($shop_product_id)
    {
        return $this->productColorRepository->index($shop_product_id);
    }

    public function store(CreateProductColor $request, $shop_product_id)
    {
        return $this->productColorRepository->store($request, $shop_product_id);
    }

    public function destroy($id)
    {
        return $this->productColorRepository->delete($id);
    }
}

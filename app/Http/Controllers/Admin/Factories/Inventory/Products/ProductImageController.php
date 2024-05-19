<?php

namespace App\Http\Controllers\Admin\Factories\Inventory\Products;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Factories\Inventory\Repositories\ProductImageRepository;
use App\SCM\Admin\Factories\Inventory\Requests\CreateProductImage;

class ProductImageController extends Controller
{
    private ProductImageRepository $productImageRepository;

    public function __construct(ProductImageRepository $productImageRepository)
    {
        $this->productImageRepository = $productImageRepository;
    }

    public function index($product_id)
    {
        return $this->productImageRepository->index($product_id);
    }

    public function store(CreateProductImage $request, $product_id)
    {
        return $this->productImageRepository->store($request, $product_id);
    }

    public function destroy($id)
    {
        return $this->productImageRepository->destroy($id);
    }
}

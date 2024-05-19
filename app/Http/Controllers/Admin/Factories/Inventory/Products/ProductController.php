<?php

namespace App\Http\Controllers\Admin\Factories\Inventory\Products;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Factories\Inventory\Repositories\ProductRepository;
use App\SCM\Admin\Factories\Inventory\Requests\CreateProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function index($category_id)
    {
        return $this->productRepository->getProductsForSpecificCategory($category_id);
    }


    public function store(CreateProduct $request, $category_id)
    {
        return $this->productRepository->store($request, $category_id);
    }


    public function show($id)
    {
        return $this->productRepository->show($id);
    }


    public function update(Request $request, $id)
    {
        return $this->productRepository->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->productRepository->destroy((int)$id);
    }

    public function search(Request $request)
    {
        return $this->productRepository->search1($request);
    }
}

<?php

namespace App\Http\Controllers\Admin\Factories\Inventory\Products;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Factories\Inventory\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index($factory_id)
    {
        return $this->categoryRepository->index($factory_id);
    }

    public function viewMainCategory($factory_id)
    {
        return $this->categoryRepository->viewMainCategory($factory_id);
    }

    public function viewChildCategory($category_id, $factory_id)
    {
        return $this->categoryRepository->viewChildCategory($category_id, $factory_id);
    }

    public function createMainCategory(Request $request, $factory_id)
    {
        return $this->categoryRepository->createMainCategory($request, $factory_id);
    }

    public function createChildCategory(Request $request, $category_id, $factory_id)
    {
        return $this->categoryRepository->createChildCategory($request, $category_id, $factory_id);
    }


    public function update(Request $request, $id)
    {
        return $this->categoryRepository->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return $this->categoryRepository->search($search);
    }
}

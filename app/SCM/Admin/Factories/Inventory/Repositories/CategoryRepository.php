<?php

namespace App\SCM\Admin\Factories\Inventory\Repositories;

use App\SCM\Admin\Factories\Inventory\Models\Category;
use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Http\Request;

class CategoryRepository extends AbstractRepository
{
    public function __construct(Category $category)
    {
        $this->setModel($category);
    }

    public function index($factory_id)
    {
        return Category::where('factory_id', $factory_id)->get();
    }


    public function viewMainCategory($factory_id)
    {
        return Category::where('parent_id', null)
            ->where('factory_id', $factory_id)
            ->get();
    }

    public function createMainCategory(Request $request, $factory_id)
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->factory_id = $factory_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('CategoryImages', 'public');
            $data['image'] = $imagePath;
        }

        $category->save();
        return $category;
    }

    public function viewChildCategory($category_id, $factory_id)
    {
        return Category::where('parent_id', $category_id)
            ->where('factory_id', $factory_id)
            ->get();
    }


    public function createChildCategory(Request $request, $category_id, $factory_id)
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->factory_id = $factory_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('CategoryImages', 'public');
            $category->image = $imagePath;
        }

        if ($request->id === $category_id) {
            $category->parent_id = $category_id;
        }

        $category->save();
        return $category;
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $model = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('CategoryImages', 'public');
            $data['image'] = $imagePath;
        }

        return $this->edit($data, $model);
    }
}

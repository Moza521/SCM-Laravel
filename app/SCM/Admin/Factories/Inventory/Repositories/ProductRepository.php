<?php

namespace App\SCM\Admin\Factories\Inventory\Repositories;

use App\SCM\Admin\Factories\Inventory\Models\Category;
use App\SCM\Admin\Factories\Inventory\Models\Product;
use App\SCM\Admin\Factories\Inventory\Models\ProductImage;
use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class ProductRepository extends AbstractRepository
{
    public function __construct(Product $product)
    {
        $this->setModel($product);
    }

    public function all()
    {
        return Product::with('color', 'size', 'image')->get();
    }


    public function getProductsForSpecificCategory($category_id)
    {
        return Product::with('color', 'size', 'image')->where('category_id', $category_id)->get();
    }


    public function store(Request $request, $category_id)
    {

        $product = new Product();

        // $category = Category::findOrFail($Category_id);
        // if ($category->parent_id == null) {
        //     return response()->json(['status' => 'Can Not Add Product In Main Category'], JsonResponse::HTTP_BAD_REQUEST);
        // }
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->quantity = $request->get('quantity');
        $product->discount_price = $request->get('discount_price');
        $product->active = $request->get('active');
        $product->category_id = $category_id;

        $product->save();
        return $product;
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $model = Product::findOrFail($id);

        return $this->edit($data, $model);
    }

    public function show($id)
    {
        return Product::with('color', 'size', 'image')->where('id', $id)->get();
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);

        $productImage = ProductImage::where('product_id', $id)->first();


        if (!empty($productImage->image)) {
            Storage::disk('public')->deleteDirectory('productImages/' . $productImage->product_id);
        }

        $product->delete();

        return response()->json(['status' => 'deleted'], 200);
    }

    public function search1(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $products = Product::where('name', 'like', "%{$search}%")->with('color', 'size', 'image')->get();
        } else {
            $products = Product::with('color', 'size', 'image')->get();
        }

        return response()->json($products);
    }
}

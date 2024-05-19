<?php

namespace App\SCM\Admin\Factories\Inventory\Repositories;

use App\SCM\Admin\Factories\Inventory\Models\Product;
use App\SCM\Admin\Factories\Inventory\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageRepository
{
    public function index($product_id)
    {
        Product::findOrFail($product_id);

        return ProductImage::select('image')->where('product_id', $product_id)->get();
    }


    public function store(Request $request, $product_id)
    {
        Product::findOrFail($product_id);

        $productImage = new ProductImage();
        $productImage->product_id = $product_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('productImages', 'public');
            $productImage->image = $imagePath;
        }

        $productImage->save();
        return $productImage;
    }


    public function destroy(int $id)
    {
        $productImage = ProductImage::findOrFail($id);

        Storage::disk('public')->delete($productImage->image);


        $productImage->delete();

        return response()->json(['status' => 'deleted'], 200);
    }
}

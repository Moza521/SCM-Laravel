<?php

namespace App\SCM\Admin\Shops\Repositories;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\SCM\Admin\Shops\Models\Shop;
use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Support\Facades\Storage;


class ShopRepository extends AbstractRepository
{

    public function __construct(Shop $shop)
    {
        $this->setModel($shop);
    }

    public function index($company_id)
    {
        return Shop::where('company_id', $company_id)->get();
    }

    public function store(Request $request, $company_id)
    {
        $shop = new Shop();
        $user = User::findOrFail($request->get('user_id'));
        $shop->name = $request->get('name');
        $shop->address = $request->get('address');
        $shop->company_id = $company_id;
        if ($user->role == 3) {
            $shop->user_id = $request->get('user_id');
        } else {
            return response()->json(['status' => 'Shop Admin ID must be ID Shop Admin'], JsonResponse::HTTP_NOT_FOUND);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('shop', 'public');
            $shop->image = $imagePath;
        }

        $shop->save();
        return $shop;
    }


    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);
        $user = User::findOrFail($request->get('user_id'));
        $shop->name = $request->get('name');
        $shop->address = $request->get('address');
        if ($user->role == 3) {
            $shop->user_id = $request->get('user_id');
        } else {
            return response()->json(['status' => 'Shop Admin ID must be ID Shop Admin'], JsonResponse::HTTP_NOT_FOUND);
        }
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($shop->image);
            $image = $request->file('image');
            $imagePath = $image->store('shop', 'public');
            $shop->image = $imagePath;
        }

        $shop->save();
        return $shop;
    }

    public function showShopInfoForSpecificAdmin()
    {
        $shopInfo = Shop::where('user_id', auth()->user()->id)->first();
        return $shopInfo;
    }
}

<?php

namespace App\Http\Controllers\Admin\Shops;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Shops\Repositories\ShopRepository;
use App\SCM\Admin\Shops\Requests\CreateShop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private ShopRepository $shopRepository;

    public function __construct(ShopRepository $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }


    public function index($company_id)
    {
        return $this->shopRepository->index($company_id);
    }


    public function store(CreateShop $request, $company_id)
    {
        return $this->shopRepository->store($request, $company_id);
    }


    public function show($id)
    {
        return $this->shopRepository->find($id);
    }

    public function showShopInfoForSpecificAdmin()
    {
        return $this->shopRepository->showShopInfoForSpecificAdmin();
    }

    public function update(CreateShop $request, $id)
    {
        return $this->shopRepository->update($request, $id);
    }


    public function destroy(int $id)
    {
        return $this->shopRepository->delete($id);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return $this->shopRepository->search($search);
    }
}

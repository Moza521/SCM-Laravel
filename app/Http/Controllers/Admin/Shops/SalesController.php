<?php

namespace App\Http\Controllers\Admin\Shops;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Shops\Repositories\SalesRepository;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    private SalesRepository $salesRepository;

    public function __construct(SalesRepository $salesRepository)
    {
        $this->salesRepository = $salesRepository;
    }

    public function index()
    {
        return $this->salesRepository->index();
    }


    public function shopHistory($shop_id)
    {
        return $this->salesRepository->shopHistory($shop_id);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        return $this->salesRepository->create($data);
    }


    public function show($id)
    {
        return $this->salesRepository->show($id);
    }


    public function update(Request $request, $id)
    {
        return $this->salesRepository->update($request, $id);
    }


    public function destroy(int $id)
    {
        return $this->salesRepository->delete($id);
    }

    public function search(Request $request)
    {
        return $this->salesRepository->search1($request);
    }
}

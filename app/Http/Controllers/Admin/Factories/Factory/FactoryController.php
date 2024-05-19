<?php

namespace App\Http\Controllers\Admin\Factories\Factory;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Factories\Repositories\FactoryRepository;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    private FactoryRepository $factoryRepository;

    public function __construct(FactoryRepository $factoryRepository)
    {
        $this->factoryRepository = $factoryRepository;
    }
    public function index($company_id)
    {
        return $this->factoryRepository->index($company_id);
    }


    public function store(Request $request, $company_id)
    {
        return $this->factoryRepository->store($request, $company_id);
    }


    public function update(Request $request, $id)
    {
        return $this->factoryRepository->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->factoryRepository->delete($id);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return $this->factoryRepository->search($search);
    }
}

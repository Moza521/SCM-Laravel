<?php

namespace App\Http\Controllers\Admin\Suppliers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SCM\Admin\Suppliers\Repositories\SupplierRepository;

class SupplierController extends Controller
{
    private SupplierRepository $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }
    public function index($company_id)
    {
        return $this->supplierRepository->index($company_id);
    }


    public function store(Request $request, $company_id)
    {
        return $this->supplierRepository->store($request, $company_id);
    }


    public function update(Request $request, $id)
    {
        return $this->supplierRepository->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->supplierRepository->delete($id);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return $this->supplierRepository->search($search);
    }
}



    // public function index1()
    // {
    //     return $this->supplierRepository->all();
    // }
    // public function show1($id)
    // {
    //     return $this->supplierRepository->find($id);
    // }
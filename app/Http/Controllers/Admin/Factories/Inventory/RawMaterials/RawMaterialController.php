<?php

namespace App\Http\Controllers\Admin\Factories\Inventory\RawMaterials;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SCM\Admin\Factories\Inventory\Repositories\RawMaterialRepository;
use App\SCM\Admin\Factories\Inventory\Requests\CreateRawMaterial;

class RawMaterialController extends Controller
{
    private RawMaterialRepository $rawMaterialRepository;

    public function __construct(RawMaterialRepository $rawMaterialRepository)
    {
        $this->rawMaterialRepository = $rawMaterialRepository;
    }

    public function index($factory_id)
    {
        return $this->rawMaterialRepository->index($factory_id);
    }


    public function store(CreateRawMaterial $request, $supplier_id, $factory_id)
    {
        return $this->rawMaterialRepository->store($request, $supplier_id, $factory_id);
    }


    public function show($id)
    {
        return $this->rawMaterialRepository->find($id);
    }


    public function update(CreateRawMaterial $request, $id)
    {
        return $this->rawMaterialRepository->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->rawMaterialRepository->delete((int)$id);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return $this->rawMaterialRepository->search($search);
    }
}

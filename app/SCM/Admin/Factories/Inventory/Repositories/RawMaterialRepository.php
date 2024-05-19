<?php

namespace App\SCM\Admin\Factories\Inventory\Repositories;

use App\SCM\Admin\Factories\Inventory\Models\RawMaterial;
use Illuminate\Http\Request;
use App\SCM\Base\Repositories\AbstractRepository;

class RawMaterialRepository extends AbstractRepository
{
    public function __construct(RawMaterial $rawMaterial)
    {
        $this->setModel($rawMaterial);
    }

    public function index($factory_id)
    {
        return RawMaterial::where('factory_id', $factory_id)->get();
    }


    public function store(Request $request, $supplier_id, $factory_id)
    {
        $rawMaterial = new RawMaterial();
        $rawMaterial->name = $request->get('name');
        $rawMaterial->Quantity = $request->get('Quantity');
        $rawMaterial->supplier_id = $supplier_id;
        $rawMaterial->factory_id = $factory_id;

        $rawMaterial->save();
        return $rawMaterial;
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $model = RawMaterial::findOrFail($id);

        return $this->edit($data, $model);
    }
}

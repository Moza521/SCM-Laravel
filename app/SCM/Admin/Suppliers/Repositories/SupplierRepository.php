<?php

namespace App\SCM\Admin\Suppliers\Repositories;

use App\SCM\Admin\Suppliers\Models\Supplier;
use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Http\Request;

class SupplierRepository extends AbstractRepository
{
    public function __construct(Supplier $supplier)
    {
        $this->setModel($supplier);
    }

    public function index($company_id)
    {
        return Supplier::where('company_id', $company_id)->get();
    }


    public function store(Request $request, $company_id)
    {
        $supplier = new Supplier();
        $supplier->name = $request->get('name');
        $supplier->email = $request->get('email');
        $supplier->raw_materials = $request->get('raw_materials');
        $supplier->phone = $request->get('phone');
        $supplier->company_id = $company_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('supplier', 'public');
            $supplier->image = $imagePath;
        }

        $supplier->save();
        return $supplier;
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $model = Supplier::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('supplier', 'public');
            $data['image'] = $imagePath;
        }
        
        return $this->edit($data, $model);
    }
}

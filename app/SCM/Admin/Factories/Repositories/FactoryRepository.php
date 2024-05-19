<?php

namespace App\SCM\Admin\Factories\Repositories;

use App\SCM\Admin\Factories\Models\Factory;
use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Http\Request;

class FactoryRepository extends AbstractRepository
{
    public function __construct(Factory $factory)
    {
        $this->setModel($factory);
    }

    public function index($company_id)
    {
        return Factory::where('company_id', $company_id)->get();
    }


    public function store(Request $request, $company_id)
    {
        $factory = new Factory();
        $factory->name = $request->get('name');
        $factory->address = $request->get('address');
        $factory->manufactured_material = $request->get('manufactured_material');
        $factory->description = $request->get('description');
        $factory->company_id = $company_id;

        $factory->save();
        return $factory;
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $model = Factory::findOrFail($id);
        
        return $this->edit($data, $model);
    }
}

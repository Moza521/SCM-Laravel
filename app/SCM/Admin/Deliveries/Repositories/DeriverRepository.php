<?php

namespace App\SCM\Admin\Deliveries\Repositories;

use App\SCM\Admin\Deliveries\Models\Deriver;
use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Http\Request;

class DeriverRepository extends AbstractRepository
{
    public function __construct(Deriver $deriver)
    {
        $this->setModel($deriver);
    }

    public function index($company_id)
    {
        return Deriver::where('company_id', $company_id)->get();
    }


    public function store($request, $company_id)
    {
        $deriver = new Deriver();
        $deriver->name = $request->get('name');
        $deriver->car_number = $request->get('car_number');
        $deriver->phone = $request->get('phone');
        $deriver->company_id = $company_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('deriver', 'public');
            $deriver->image = $imagePath;
        }

        $deriver->save();
        return $deriver;
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $model = Deriver::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('deriver', 'public');
            $data['image'] = $imagePath;
        }

        return $this->edit($data, $model);
    }
}

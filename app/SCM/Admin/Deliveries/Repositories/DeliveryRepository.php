<?php

namespace App\SCM\Admin\Deliveries\Repositories;

use App\SCM\Admin\Deliveries\Models\Delivery;
use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Http\Request;
use App\SCM\Admin\Deliveries\Models\Deriver;

class DeliveryRepository extends AbstractRepository
{
    public function __construct(Delivery $delivery)
    {
        $this->setModel($delivery);
    }

    public function index($company_id)
    {
        return Delivery::with('product')->where('company_id', $company_id)->get();
    }

    public function getDeliveryForSpecificDestination($destination)
    {
        return Delivery::with('product')->where('destination', $destination)->get();
    }

    public function show($id)
    {
        return Delivery::with('product')->where('id', $id)->get();
    }

    public function store($request, $deriver_id, $company_id)
    {
        Deriver::findOrFail($deriver_id);
        $delivery = new Delivery();
        $delivery->destination = $request->get('destination');
        $delivery->deriver_id = $deriver_id;
        $delivery->company_id = $company_id;

        $delivery->save();
        return $delivery;
    }

    public function updateDestination($request, $id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->destination = $request->get('destination');

        $delivery->save();
        return $delivery;
    }

    public function updateDeriver($id, $deriver_id)
    {
        Deriver::findOrFail($deriver_id);
        $delivery = Delivery::findOrFail($id);
        $delivery->deriver_id = $deriver_id;

        $delivery->save();
        return $delivery;
    }
}

<?php

namespace App\Http\Controllers\Admin\Deliveries;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Deliveries\Repositories\DeliveryRepository;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    private DeliveryRepository $deliveryRepository;

    public function __construct(DeliveryRepository $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
    }
    public function index($company_id)
    {
        return $this->deliveryRepository->index($company_id);
    }

    public function getDeliveryForSpecificDestination($destination)
    {
        return $this->deliveryRepository->getDeliveryForSpecificDestination($destination);
    }

    public function show($id)
    {
        return $this->deliveryRepository->show($id);
    }

    public function store(Request $request, $deriver_id, $company_id)
    {
        return $this->deliveryRepository->store($request, $deriver_id, $company_id);
    }


    public function updateDestination(Request $request, $id)
    {
        return $this->deliveryRepository->updateDestination($request, $id);
    }

    public function updateDeriver($id, $deriver_id)
    {
        return $this->deliveryRepository->updateDeriver($id, $deriver_id);
    }
}

<?php

namespace App\Http\Controllers\Admin\Deliveries;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Deliveries\Repositories\DeliveryProductRepository;
use Illuminate\Http\Request;

class DeliveryProductController extends Controller
{
    private DeliveryProductRepository $deliveryProductRepository;

    public function __construct(DeliveryProductRepository $deliveryProductRepository)
    {
        $this->deliveryProductRepository = $deliveryProductRepository;
    }
    public function index()
    {
        return $this->deliveryProductRepository->all();
    }

    public function store($delivery_id, $product_id)
    {
        return $this->deliveryProductRepository->store($delivery_id, $product_id);
    }

    public function show($id)
    {
        return $this->deliveryProductRepository->find($id);
    }

    public function updateProducts($product_id)
    {
        return $this->deliveryProductRepository->updateProducts($product_id);
    }


    public function destroy($id)
    {
        return $this->deliveryProductRepository->delete($id);
    }
}

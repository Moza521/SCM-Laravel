<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Subscription\Repositories\SubscriptionRepository;
use App\SCM\Admin\Subscription\Requests\CreateSubscription;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }
    public function index()
    {
        return $this->subscriptionRepository->all();
    }

    public function store(CreateSubscription $request)
    {
        $data = $request->all();
        return $this->subscriptionRepository->create($data);
    }

    public function show($id)
    {
        return $this->subscriptionRepository->find($id);
    }

    public function update(Request $request, $id)
    {
        return $this->subscriptionRepository->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->subscriptionRepository->delete($id);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return $this->subscriptionRepository->search($search);
    }}

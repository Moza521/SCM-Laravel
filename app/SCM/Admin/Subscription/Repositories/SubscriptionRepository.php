<?php

namespace App\SCM\Admin\Subscription\Repositories;

use App\SCM\Admin\Subscription\Models\SubscriptionPlan;
use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Http\Request;

class SubscriptionRepository extends AbstractRepository
{
    public function __construct(SubscriptionPlan $subscriptionPlan)
    {
        $this->setModel($subscriptionPlan);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $model = SubscriptionPlan::findOrFail($id);
        
        return $this->edit($data, $model);
    }
}

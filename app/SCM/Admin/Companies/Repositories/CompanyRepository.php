<?php

namespace App\SCM\Admin\Companies\Repositories;

use App\SCM\Admin\Companies\Models\Company;
use App\SCM\Admin\Subscription\Models\SubscriptionPlan;
use App\SCM\Base\Repositories\AbstractRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyRepository extends AbstractRepository
{
    public function __construct(Company $company)
    {
        $this->setModel($company);
    }

    public function store(Request $request, $subscriptionPlan_id)
    {
        $company = new Company();
        $company->name = $request->get('name');
        $company->email = $request->get('email');
        $company->description = $request->get('description');
        $company->subscription_plan_id = $subscriptionPlan_id;

        $company->save();
        return $company;
    }

    public function update(Request $request, $id, $subscriptionPlan_id)
    {
        $company = Company::findOrFail($id);
        $company->name = $request->get('name');
        $company->email = $request->get('email');
        $company->description = $request->get('description');
        $company->subscription_plan_id = $subscriptionPlan_id;

        $company->save();
        return $company;
    }

    function changeStatusAfterOneMonth($company_id)
    {
        // Assuming today is May 14th, 2024
        // $oneMonthAgo will be assigned the value of April 14th, 2024
        $originalDateTime = Carbon::now()->subMonth();
        $oneMonthAgo = Carbon::parse($originalDateTime)->format('Y-m-d H:i:s');

        $company = Company::where('created_at', '<=', $oneMonthAgo)
            ->where('id', $company_id)
            ->where('status', 'active')
            ->first();
            
        if($company) {
            $company->status = 'inactive';
            $company->save();
        }
    }

    function changeStatusAfterOneYear($company_id)
    {
        $originalDateTime = Carbon::now()->subYear();
        $oneYearAgo = Carbon::parse($originalDateTime)->format('Y-m-d H:i:s');

        $company = Company::where('created_at', '<=', $oneYearAgo)
            ->where('id', $company_id)
            ->where('status', 'active')
            ->first();
            
        if($company) {
            $company->status = 'inactive';
            $company->save();
        }
    }

    function changeStatus($company_id)
    {
        $subscription_plan_id =
        Company::select('subscription_plan_id')
        ->where('id', $company_id)->first();

        $title = SubscriptionPlan::select('title')->where('id', $subscription_plan_id->subscription_plan_id)->first();

        if ($title === 'Monthly' || $title === 'monthly') {
            $this->changeStatusAfterOneMonth($company_id);
        } else {
            $this->changeStatusAfterOneYear($company_id);
        }
    }

    public function subscriptionRenewal($company_id)
    {
        $company = Company::findOrFail($company_id);
        $company->status = 'active';
        $company->save();
        return $company;
    }
}

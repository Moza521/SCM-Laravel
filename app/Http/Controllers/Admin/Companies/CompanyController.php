<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Companies\Models\Company;
use App\SCM\Admin\Companies\Repositories\CompanyRepository;
use App\SCM\Admin\Companies\Requests\CreateCompany;
use App\SCM\Admin\Subscription\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    public function index()
    {
        return $this->companyRepository->all();
    }

    public function store(CreateCompany $request, $subscriptionPlan_id)
    {
        return $this->companyRepository->store($request, $subscriptionPlan_id);
    }

    public function show($id)
    {
        return $this->companyRepository->find($id);
    }

    public function update(Request $request, $id, $subscriptionPlan_id)
    {
        return $this->companyRepository->update($request, $id, $subscriptionPlan_id);
    }


    public function destroy($id)
    {
        return $this->companyRepository->delete($id);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return $this->companyRepository->search($search);
    }

    public function subscriptionRenewal($company_id)
    {
        return $this->companyRepository->subscriptionRenewal($company_id);
    }
}

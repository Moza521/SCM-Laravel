<?php

namespace App\Http\Controllers\Admin\Deliveries;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Deliveries\Repositories\DeriverRepository;
use Illuminate\Http\Request;

class DeriverController extends Controller
{
    private DeriverRepository $deriverRepository;

    public function __construct(DeriverRepository $deriverRepository)
    {
        $this->deriverRepository = $deriverRepository;
    }
    public function index($company_id)
    {
        return $this->deriverRepository->index($company_id);
    }

    public function store(Request $request, $company_id)
    {
        return $this->deriverRepository->store($request , $company_id);
    }

    public function show($id)
    {
        return $this->deriverRepository->find($id);
    }

    public function update(Request $request, $id)
    {
        return $this->deriverRepository->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->deriverRepository->delete($id);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return $this->deriverRepository->search($search);
    }
}

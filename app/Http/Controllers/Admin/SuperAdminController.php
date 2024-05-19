<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SCM\Admin\AdminServices\Repositories\AdminRepository;
use App\SCM\Admin\AdminServices\Requests\CreateAdmin;
use App\SCM\Admin\AdminServices\Requests\CreateUserImage;
use App\SCM\Admin\AdminServices\Requests\editProfile;

class SuperAdminController extends Controller
{
    private AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function addAdmin(CreateAdmin $request, $company_id)
    {
        return $this->adminRepository->addAdmin($request, $company_id);
    }


    public function addImage(CreateUserImage $request, $id)
    {
        return $this->adminRepository->addImage($request, $id);
    }


    public function editProfile(editProfile $request, $id)
    {
        return $this->adminRepository->editProfile($request, $id);
    }


    public function deleteImage($id)
    {
        return $this->adminRepository->deleteImage($id);
    }


    public function allUsers()
    {
        return $this->adminRepository->allUsers();
    }


    public function search(Request $request)
    {
        $search = $request->input('search');
        return $this->adminRepository->search($search);
    }
}

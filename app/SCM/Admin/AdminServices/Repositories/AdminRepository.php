<?php

namespace App\SCM\Admin\AdminServices\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\SCM\Admin\Companies\Models\Company;
use App\SCM\Base\Repositories\AbstractRepository;

class AdminRepository extends AbstractRepository
{
    public function __construct(User $user)
    {
        $this->setModel($user);
    }

    // role = 2 --> factory Admin
    // role = 3 --> shop Admin
    // role = 4 --> company Admin
    public function addAdmin(Request $request, $company_id)
    {
        $user = new User();
        if ($request->get('role') === 2 || $request->get('role') === 3 || $request->get('role') === 4) {

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->password);
            $user->company_id = $company_id;
            $user->role = $request->get('role');
            if ($request->get('phone')) {
                $user->phone = $request->get('phone');
            }
    
            $user->save();
    
            return response()->json([
                'message' => 'User create successfully',
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'status' => 'Something is Wrong'
            ]);
        }
    }

    public function addImage(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('usersImage', 'public');
            $user->image = $imagePath;
        }

        $user->save();
        return response()->json([
            'access_token' => Auth::refresh(),
            'user' => $user,
        ]);
    }

    public function updateImage(Request $request, $user)
    {
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($user->image);
            $user->image = null;
            $image = $request->file('image');
            $imagePath = $image->store('usersImage', 'public');
            $user->image = $imagePath;
        }

        $user->save();
        return $user;
    }

    public function updateName(Request $request, $user)
    {
        $user->name = $request->get('name');

        $user->save();
        return $user;
    }

    public function updatePassword(Request $request, $user)
    {
        $user->password = bcrypt($request->password);

        $user->save();
        return $user;
    }

    public function editProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->get('name')) {
            $this->updateName($request, $user);
        }

        if ($request->get('password')) {
            $this->updatePassword($request, $user);
        }

        if ($request->hasFile('image')) {
            $this->updateImage($request, $user);
        }

        return response()->json([
            'access_token' => Auth::refresh(),
            'user' => $user,
        ]);
    }

    public function deleteImage($id)
    {
        $user = User::findOrFail($id);

        if (empty($user->image)) {
            return response()->json([
                'access_token' => Auth::refresh(),
                'status' => 'There Is No Image To Delete'
            ]);
        }

        if (!empty($user->image)) {
            Storage::disk('public')->delete($user->image);
            $user->image = null;
        }

        $user->save();
        return response()->json([
            'access_token' => Auth::refresh(),
            'status' => 'image deleted',
        ]);
    }

    public function allUsers()
    {
        return User::with('shop')->select('id', 'name', 'email', 'role', 'image', 'company_id')->get();
    }
}

<?php

namespace App\SCM\Base\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AbstractRepository implements RepositoryInterface
{
    protected Model $model;

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        foreach ($data as $filed => $val) {
            $this->model->{$filed} = $val;
        }
        $this->model->save();
        return $this->model;
    }

    public function edit(array $data, $model)
    {
        if (!empty($data['image'])) {
            Storage::disk('public')->delete($model->image);
        }
        foreach ($data as $filed => $val) {
            $model->{$filed} = $val;
        }
        $model->save();
        return $model;
    }

    public function delete($id)
    {
        $this->model = $this->model->findOrFail($id);

        if (!empty($this->model->image)) {
            Storage::disk('public')->delete($this->model->image);
        }

        $this->model->delete();

        return response()->json(['status' => 'deleted Successfully'], 200);
    }


    public function search($search)
    {
        if ($search) {
            $result = $this->model->where('name', 'like', "%{$search}%")->get();
        } else {
            return response()->json(['status' => 'Inter Search Word'], 400);
        }

        return response()->json($result);
    }


    public function getModel()
    {
        return $this->model;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }
}


// public function edit(array $data, $id)
// {
//     if (!empty($data['image'])) {
//         Storage::disk('public')->delete($this->model->image);
//     }
//     foreach ($data as $filed => $val) {
//         $this->model->{$filed} = $val;
//     }
//     $this->model->save();
//     return $this->model;
// }
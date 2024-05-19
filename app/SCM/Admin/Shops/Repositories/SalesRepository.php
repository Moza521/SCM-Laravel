<?php

namespace App\SCM\Admin\Shops\Repositories;

use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Http\Request;
use App\SCM\Admin\Shops\Models\Sales;

class SalesRepository extends AbstractRepository
{
    public function __construct(Sales $sales)
    {
        $this->setModel($sales);
    }


    public function shopHistory($shop_id)
    {
        return Sales::with('product')->where('shop_id', $shop_id)->get();
    }

    public function show($id)
    {
        return Sales::with('product')->where('id', $id)->get();
    }

    public function index()
    {
        return Sales::with('product')->get();
    }

    public function search1(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $sales = Sales::with('product')->where('shop_id', 'like', "%{$search}%")->get();
        } else {
            $sales = Sales::with('product')->get();
        }

        return response()->json($sales);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $model = Sales::findOrFail($id);

        return $this->edit($data, $model);
    }
}

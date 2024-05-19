<?php

namespace App\SCM\Admin\Factories\ProductionScheduling\Repositories;

use App\SCM\Admin\Factories\ProductionScheduling\Models\Schedule;
use App\SCM\Base\Repositories\AbstractRepository;
use Illuminate\Http\Request;

class ScheduleRepository extends AbstractRepository
{
    public function __construct(Schedule $schedule)
    {
        $this->setModel($schedule);
    }

    public function index($factory_id)
    {
        return Schedule::with('images')->where('factory_id', $factory_id)->get();
    }

    public function show($id)
    {
        return Schedule::with('images')->where('id', $id)->get();
    }

    public function store(Request $request, $factory_id)
    {
        $data = $request->all();

        $schedule = new Schedule;
        $schedule->name = $data['name'];
        $schedule->description = $data['description'];
        $schedule->price = $data['price'];
        $schedule->category_id = $data['category_id'];
        $schedule->quantity = $data['quantity'];
        $schedule->status = $data['status'];
        $schedule->factory_id = $factory_id;
        $schedule->colors = json_encode($data['colors']);
        $schedule->sizes = json_encode($data['sizes']);

        $schedule->save();

        return response()->json($schedule, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $schedule = Schedule::findOrFail($id);
        $schedule->name = $data['name'];
        $schedule->description = $data['description'];
        $schedule->price = $data['price'];
        $schedule->category_id = $data['category_id'];
        $schedule->quantity = $data['quantity'];
        $schedule->status = $data['status'];
        $schedule->colors = json_encode($data['colors']);
        $schedule->sizes = json_encode($data['sizes']);

        $schedule->save();

        return response()->json($schedule, 201);
    }
}

<?php

namespace App\Http\Controllers\Admin\Factories\ProductionScheduling;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Factories\ProductionScheduling\Repositories\ScheduleRepository;
use App\SCM\Admin\Factories\ProductionScheduling\Requests\CreateSchedule;

class ScheduleController extends Controller
{
    private ScheduleRepository $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function index($factory_id)
    {
        return $this->scheduleRepository->index($factory_id);
    }

    public function store(CreateSchedule $request, $factory_id)
    {
        return $this->scheduleRepository->store($request, $factory_id);
    }

    public function update(CreateSchedule $request, $id)
    {
        return $this->scheduleRepository->update($request, $id);
    }

    public function show($id)
    {
        return $this->scheduleRepository->show($id);
    }

    public function destroy($id)
    {
        return $this->scheduleRepository->delete($id);
    }
}

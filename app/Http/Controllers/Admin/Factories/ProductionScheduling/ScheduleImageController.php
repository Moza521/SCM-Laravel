<?php

namespace App\Http\Controllers\Admin\Factories\ProductionScheduling;

use App\Http\Controllers\Controller;
use App\SCM\Admin\Factories\ProductionScheduling\Repositories\ScheduleImageRepository;
use App\SCM\Admin\Factories\ProductionScheduling\Requests\CreateScheduleImage;
use Illuminate\Http\Request;

class ScheduleImageController extends Controller
{
    private ScheduleImageRepository $scheduleImageRepository;

    public function __construct(ScheduleImageRepository $scheduleImageRepository)
    {
        $this->scheduleImageRepository = $scheduleImageRepository;
    }

    public function index($schedule_id)
    {
        return $this->scheduleImageRepository->index($schedule_id);
    }

    public function store(Request $request, $schedule_id)
    {
        return $this->scheduleImageRepository->store($request, $schedule_id);
    }

    public function destroy($id)
    {
        return $this->scheduleImageRepository->destroy($id);
    }
}

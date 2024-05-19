<?php

namespace App\SCM\Admin\Factories\ProductionScheduling\Repositories;

use App\SCM\Admin\Factories\ProductionScheduling\Models\Schedule;
use App\SCM\Admin\Factories\ProductionScheduling\Models\ScheduleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScheduleImageRepository
{
    public function index($schedule_id)
    {
        Schedule::findOrFail($schedule_id);

        return ScheduleImage::where('schedule_id', $schedule_id)->get();
    }


    public function store(Request $request, $schedule_id)
    {
        Schedule::findOrFail($schedule_id);

        $scheduleImage = new ScheduleImage();
        $scheduleImage->schedule_id = $schedule_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('scheduleImage', 'public');
            $scheduleImage->image = $imagePath;
        }

        $scheduleImage->save();
        return $scheduleImage;
    }


    public function destroy(int $id)
    {
        $productImage = ScheduleImage::findOrFail($id);

        Storage::disk('public')->delete($productImage->image);


        $productImage->delete();

        return response()->json(['status' => 'deleted'], 200);
    }
}

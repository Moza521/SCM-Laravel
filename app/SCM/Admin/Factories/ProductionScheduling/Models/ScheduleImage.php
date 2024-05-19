<?php

namespace App\SCM\Admin\Factories\ProductionScheduling\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'product_id',
    ];

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
}

<?php

namespace App\SCM\Admin\Factories\ProductionScheduling\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'quantity',
        'status',
        'colors',
        'sizes',
        'images',
    ];

    public function images()
    {
        return $this->hasMany(ScheduleImage::class);
    }
}

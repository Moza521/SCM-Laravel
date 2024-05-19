<?php

namespace App\SCM\Admin\Deliveries\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination',
        'deriver_id',
    ];

    public function deriver()
    {
        return $this->hasOne(Deriver::class);
    }

    public function product()
    {
        return $this->hasMany(DeliveryProduct::class);
    }
}

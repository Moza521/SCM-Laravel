<?php

namespace App\SCM\Admin\Factories\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'Quantity',
        'supplier_id',
        'factory_id',
    ];

}

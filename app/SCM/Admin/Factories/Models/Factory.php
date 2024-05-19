<?php

namespace App\SCM\Admin\Factories\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'manufactured_material',
        'description',
        'company_id'
    ];
}

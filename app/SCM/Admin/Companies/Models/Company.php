<?php

namespace App\SCM\Admin\Companies\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'description',
        'status',
        'subscription_plan_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}

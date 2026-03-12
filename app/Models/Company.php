<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'email',
        'address',
        'is_active',
        'is_deleted'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $fillable = [
        'district_name',
        'is_deleted',
    ];

    // If you want default value when inserting
    protected $attributes = [
        'is_deleted' => 1,
    ];
}

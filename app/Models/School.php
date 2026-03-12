<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\IsDeletedScope;

class School extends Model
{
    protected $table = "schools";

    protected $primaryKey = "id";

    public $timestamps = false; // because you have createts

    protected $fillable = [
        'location',
        'city',
        'district',
        'modee',
        'name',
        'address',
        'contactperson',
        'contactno',
        'courses',
        'school_images',
        'createdby',
        'createts',
        'is_deleted',
    ];

    protected $casts = [
        'school_images' => 'array',
    ];
    protected static function booted()
{
    static::addGlobalScope(new IsDeletedScope);
}
}

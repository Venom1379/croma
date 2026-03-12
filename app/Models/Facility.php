<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\IsDeletedScope;

class Facility extends Model
{
    protected $table = "facility";

    protected $primaryKey = "fid";

    public $timestamps = false; // because you have createts not created_at

    protected $fillable = [
        'facilityname',
        'facilitypic',
        'facilitytype',
        'facilitylocation',
        'city',
        'district',
        'facilityaddress',
        'contactperson',
        'contactnumber',
        'facilitybdetails',
        'facilitylinks',
        'createdby',
        'createts',
        'category',
        'is_deleted',
    ];

    protected $casts = [
        'facilitypic'   => 'array',
        'facilitylinks' => 'array',
    ];
    protected static function booted()
{
    static::addGlobalScope(new IsDeletedScope);
}
}

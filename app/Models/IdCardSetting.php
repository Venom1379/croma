<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdCardSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_logo',
        'background_color',
        'top_strip',
        'signature_image',
    ];
}

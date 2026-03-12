<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\IsDeletedScope;

class ArtForm extends Model
{
    protected $table = 'art_forms';

    protected $fillable = [
        'name',
        'description',
        'is_deleted',
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
    ];
    public function images()
    {
        return $this->hasMany(ArtFormImage::class);
    }
    protected static function booted()
{
    static::addGlobalScope(new IsDeletedScope);
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramGroupArtist extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'artist_id'
    ];

    public function group()
    {
        return $this->belongsTo(ProgramGroup::class, 'group_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}

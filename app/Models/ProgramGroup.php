<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'name',
        'description',
        'is_deleted'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    // public function artists()
    // {
    //     return $this->hasMany(ProgramGroupArtist::class, 'group_id');
    // }
    public function artists()
    {
        return $this->belongsToMany(User::class, 'program_group_artists', 'group_id', 'artist_id');
    }

}

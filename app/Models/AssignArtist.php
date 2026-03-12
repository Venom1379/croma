<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignArtist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'program_id','group_id'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'user_id')->artists();
    }
    public function group()
    {
        return $this->belongsTo(ProgramGroup::class, 'group_id');
    }
}

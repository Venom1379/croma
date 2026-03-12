<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundAllocation extends Model
{
    protected $fillable = [
        'program_id',
        'artist_id',
        'allocated_amount',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}

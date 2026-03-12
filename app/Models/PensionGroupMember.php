<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PensionGroupMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'pension_group_id',
        'user_id',
        'note',
        'is_deleted',
    ];

    public function group()
    {
        return $this->belongsTo(PensionGroup::class, 'pension_group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

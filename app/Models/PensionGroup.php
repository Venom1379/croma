<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PensionGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'note',
        'is_deleted',
    ];

    public function members()
    {
        return $this->hasMany(PensionGroupMember::class, 'pension_group_id');
    }

    public function payments()
    {
        return $this->hasMany(PensionGroupPayment::class, 'pension_group_id');
    }
}

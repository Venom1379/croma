<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PensionGroupPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pension_group_id',
        'month',
        'total_amount',
        'per_member_amount',
        'status',
        'paid_date',
        'note',
        'is_deleted',
    ];

    public function group()
    {
        return $this->belongsTo(PensionGroup::class, 'pension_group_id');
    }
}

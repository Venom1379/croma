<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PensionPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pensioner_id',
        'pension_group_id',
        'pension_group_payment_id',
        'month',
        'amount',
        'status',
        'paid_date',
        'note',
        'is_deleted',
    ];

    public function pensioner()
    {
        return $this->belongsTo(Pensioner::class);
    }
}

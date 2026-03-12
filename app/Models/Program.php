<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\IsDeletedScope;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'date', 'time', 'financial_amount',
        'program_incharge', 'program_incharge_phone', 'vip_present',
        'vip_name', 'nature_of_admission','number_of_participants',
        'village', 'mandal', 'district', 'pincode'
    ];

    public function artists()
    {
        return $this->belongsToMany(User::class, 'assign_artists', 'program_id', 'user_id')->artists();
    }
    
    public function fundAllocations()
    {
        return $this->hasMany(FundAllocation::class);
    }
    public function groups()
    {
        return $this->hasMany(ProgramGroup::class);
    }
    protected static function booted()
{
    static::addGlobalScope(new IsDeletedScope);
}
}

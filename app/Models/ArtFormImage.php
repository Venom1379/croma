<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtFormImage extends Model
{
    protected $fillable = [
        'art_form_id',
        'image',
    ];

    public function artForm()
    {
        return $this->belongsTo(ArtForm::class);
    }
}

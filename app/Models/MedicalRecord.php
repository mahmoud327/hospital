<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model  implements HasMedia
{
    use  HasFactory;
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'user_id',
        'medical_type_id'
    ];

    public function getImageAttribute()
    {
        if (($images = $this->getMedia('medical_records'))->count()) {
            return asset(optional($this->getFirstMedia('medical_records'))->getUrl());
        }
        return asset('awarebox.jpeg');
    }
    public function medicalType()
    {
         return  $this->belongsTo(MedicalType::class);
    }
}


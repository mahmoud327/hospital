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
        'user_id'

    ];
}

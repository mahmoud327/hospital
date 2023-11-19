<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProviderSchedule extends Model
{

    public $timestamps = true;

    protected $fillable = array('service_provider_id', 'from', 'to','date','day');


}

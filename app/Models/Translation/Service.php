<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class Service extends Model {

    protected $table = "service_translations";

    protected $fillable = ['name','service_id','locale','desc'];


    public $timestamps = true;

}

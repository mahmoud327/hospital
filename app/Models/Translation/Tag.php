<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $table = "tags_translations";

    protected $fillable = ['name','tag_id','locale'];


    public $timestamps = true;

}

<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

    protected $table = "banner_translations";

    protected $fillable = ['title','description'];

    protected $guarded = ['banner_id'];

    public $timestamps = false;

}

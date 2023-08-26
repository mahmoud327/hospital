<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

    protected $table = "blog_translations";

    protected $fillable = ['title','description','locale','blog_id'];

    protected $guarded = ['blog_id'];

    public $timestamps = false;

}

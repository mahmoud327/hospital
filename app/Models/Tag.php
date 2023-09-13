<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use \Astrotomic\Translatable\Translatable;

    protected $with = [
        'translations',
    ];

    protected $translationForeignKey = "tag_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Translation\Tag';
    protected $table = "tags";

    public $timestamps = true;

    protected $fillable = array('name', 'desc', 'parent_id','image');




   
}

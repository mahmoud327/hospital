<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use \Astrotomic\Translatable\Translatable;

    protected $with = [
        'translations',
    ];

    protected $translationForeignKey = "service_id";
    public $translatedAttributes = ['name', 'desc'];
    public $translationModel = 'App\Models\Translation\Service';
    protected $table = "services";

    public $timestamps = true;

    protected $fillable = array('name', 'desc', 'parent_id','image');

    public function parents()
    {
        return $this->belongsTo(Service::class, 'parent_id', 'id');
    }


    /**
     * @return mixed
     */
    public function childs()
    {
        return $this->hasMany(Service::class, 'parent_id', 'id');
    }

    public function getImagEpathAttribute(){
       return   $this->image?asset('uploads/services/'.$this->image):'null';
    }

    /**
     * @return mixed
     */
}

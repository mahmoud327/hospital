<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cron\ByClick;
use App\Models\Cron\ByTime;

class Banner extends Model
{

    use \Astrotomic\Translatable\Translatable;

    protected $with = [
        'translations'
    ];
    protected $appends = [
        'image_path',
    ];



    protected $translationForeignKey = "banner_id";
    public $translatedAttributes = ['title'];

    public $translationModel = 'App\Models\Translation\Banner';
    protected $table = "banners";
    protected $fillable = ['link', 'image', 'position', 'status', 'banner_type'];




    static  public  function getPosition()
    {
        return [



            (object)[
                'id'    =>  'academy',
                'name'  => 'academy',
            ],

            (object)[
                'id'    =>  'network',
                'name'  => 'network',
            ],

            (object)[
                'id'    =>  'incubator',
                'name'  => 'incubator',
            ],

            (object)[
                'id'    => 'service-provider',
                'name'  => 'service-provider',
            ],
        ];
    }

    static  public  function GetStatus()
    {
        return [
            (object)[
                'id'    =>  0,
                'name'  =>  'OFF',
            ],
            (object)[
                'id'    =>  1,
                'name'  =>  'ON',
            ],
        ];
    }




    public function getImagePathAttribute()
    {
        return $this->image ? asset('uploads/banners/' . $this->image) : asset('uploads/default.jpeg');
    }
}

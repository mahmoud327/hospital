<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;

    protected $fillable = [
       'about_us',
       'phone',
       'address',
       "terms_conditions",
       'fb_link',
       'tw_link',
       'linkedin_link',
       'inst_link',
       'whatsapp_link',
       'skype_link',
    ];


}


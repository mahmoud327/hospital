<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderService extends Model
{

    protected $table="order_service";
    protected $fillable = array('order_id', 'service_id','price','price_negotiation');


}

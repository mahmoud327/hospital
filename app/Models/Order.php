<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use League\Glide\Server;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Order extends Model
{
    protected $table = 'orders';
    protected $with=['user'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'service_provider_id',
        "status",
        "note",
        "appointment",
        "price_negotiation",
        "total",
    ];
    public function services()
    {
       return $this->belongsToMany(Service::class,'order_service')->withPivot('price');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
}

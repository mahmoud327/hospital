<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Multicaret\Acquaintances\Traits\CanBeRated;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class ServiceProvider extends Model implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable;
    use InteractsWithMedia;
    use CanBeRated;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'num_experience',
        'is_staff',
        'service_id',
        'national_id',
        'startDate',
        'cv',
        "bio",
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'service_provider_tag');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function services()
    {
        return $this->belongsToMany(Service::class,'service_provider_service')->withPivot('price');
    }
    public function schedules()
    {
        return $this->hasMany(ServiceProviderSchedule::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }


    public function getRatesAttribute()
    {
        return $this->ratingsPure()->avg('relation_value') ?? 0;
    }



    public function getIsComplateProfileAttribute()
    {
        if (($this->getMedia('service_providers'))->count()
            && ($this->getMedia('cards'))->count()
            && ($this->getMedia('business_cards'))->count()
            && $this->cv
            && $this->national_id
        ) {
            return true;
        }
        return false;
    }
    public function getImageCardAttribute()
    {
        if (($images = $this->getMedia('cards'))->count()) {
            return asset(optional($this->getFirstMedia('cards'))->getUrl());
        }
        return asset('awarebox.jpeg');
    }
    public function getImageAttribute()
    {
        if (($images = $this->getMedia('service_providers'))->count()) {
            return asset(optional($this->getFirstMedia('service_providers'))->getUrl());
        }
        return asset('awarebox.jpeg');
    }
    public function getImageBusinessCardAttribute()
    {
        if (($images = $this->getMedia('business_cards'))->count()) {
            return asset(optional($this->getFirstMedia('business card'))->getUrl());
        }
        return asset('awarebox.jpeg');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Multicaret\Acquaintances\Traits\CanRate;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use CanRate;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'phone',
        'last_name',
        'first_name',
        'longitude',
        'address',
        'gender',
        'birth_date',
        'latitude',
        'type',
        "fcm_token",
        'service_provider_id'
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

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
    }
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
    public function getAgeAttribute()
    {
        // Calculate the age based on the birthdate
        return Carbon::parse($this->birth_date)->age;
    }
}

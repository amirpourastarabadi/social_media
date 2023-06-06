<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'uuid',
        'password',
        'email_verified_at'
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
        'password' => 'hashed',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function authToken():Attribute
    {
        return Attribute::make(
            get: fn() => JWTAuth::fromUser($this)
        );
    }

    public function isVerified():Attribute
    {
        return Attribute::make(
            get: fn() => !is_null($this->email_verified_at)
        );
    }

    public function emailToken()
    {
        return $this->hasMany(EmailVerification::class);
    }

    public function firstValidToken(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->emailToken()->unused()->first()?->token
        );
    }

    public function emailVerificationLink(): Attribute
    {
        return Attribute::make(
            get: fn () => route(
                'email_verification',
                [
                    'token' => $this->first_valid_token,
                    'email' => $this->email,
                ]
            )
        );
    }
}

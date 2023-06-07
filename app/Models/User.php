<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Sanctum\HasApiTokens;

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

    public static function attemptToLogin(array $credentials)
    {
        $auth_token = Auth::attempt($credentials);

        if (!$auth_token) {
            return false;
        }

        $user = auth()->user();
        $user->jwt_token = $auth_token;

        return $user;
    }

    public function authToken(): Attribute
    {
        return Attribute::make(
            get: fn () => is_null($this->jwt_token) ? JWTAuth::fromUser($this) : $this->jwt_token
        );
    }

    public function emailVerificationToken(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->emailToken()->first()?->token
        );
    }

    public function resetPasswordToken(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->passwordResetToken()->first()?->token
        );
    }

    public function emailVerificationLink(): Attribute
    {
        return Attribute::make(
            get: fn () => route(
                'email_verification',
                [
                    'token' => $this->email_verification_token,
                    'email' => $this->email,
                ]
            )
        );
    }

    public function resetPasswordLink(): Attribute
    {
        return Attribute::make(
            get: fn () => route(
                'password.reset.form',
                [
                    'token' => $this->reset_password_token,
                    'email' => $this->email,
                ]
            )
        );
    }

    public function isVerified(): Attribute
    {
        return Attribute::make(
            get: fn () => !is_null($this->email_verified_at)
        );
    }

    public function createDefaultProfile()
    {
        $this->profile()->create();
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function emailToken()
    {
        return $this->hasMany(EmailVerification::class);
    }

    public function passwordResetToken()
    {
        return $this->hasMany(PasswordReset::class);
    }
}

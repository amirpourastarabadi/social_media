<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    public $table = 'email_verification_tokens';

    public $timestamps = false;

    public $fillable = [
        'user_id',
        'verified_at',
        'token'
    ];

    public $hidden = [
        'token'
    ];

    public $casts = [
        'verified_at' => 'datetime'
    ];

    public function scopeUnused(Builder $builder): Builder
    {
        return $builder->whereNull('verified_at')->limit(1);
    }

    public static function generateTokenFor(User $user)
    {
        static::create([
            'user_id' => $user->id
        ]);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}

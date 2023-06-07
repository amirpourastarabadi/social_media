<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    public $table = 'password_resets';

    public $timestamps = false;

    public $fillable = [
        'user_id',
        'token',
        'created_at',
    ];


    public static function generateTokenForUser(User $user)
    {
        static::create([
            'user_id' => $user->id,
        ]);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

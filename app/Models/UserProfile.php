<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    public $fillable = [
        'bio',
        'image'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

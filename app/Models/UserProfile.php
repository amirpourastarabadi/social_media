<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    private const DEFAULT_IMAGE = 'default_user_profile_image.jpeg';

    public $fillable = [
        'bio',
        'image'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function imageFullPath():Attribute
    {
        return Attribute::make(
            get: fn() => $this->image === static::DEFAULT_IMAGE ? static::DEFAULT_IMAGE : $this->updated_at->toDateString() . '/' . $this->image 
        );
    }
}

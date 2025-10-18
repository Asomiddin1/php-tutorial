<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🧩 Har bir foydalanuvchi ko‘p postlarga ega bo‘ladi (1:N)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // 💬 Har bir foydalanuvchi ko‘p kommentlarga ega bo‘ladi (1:N)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

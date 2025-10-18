<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Form orqali saqlanishiga ruxsat berilgan ustunlar
    protected $fillable = ['title', 'body', 'user_id'];

    // 🧩 Postga tegishli izohlar (1:N)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 👤 Post egasi (N:1)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

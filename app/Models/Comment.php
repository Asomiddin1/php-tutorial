<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Formdan qabul qilinadigan ustunlar
    protected $fillable = ['post_id', 'user_id', 'comment'];

    // 🧩 Izoh qaysi postga tegishli
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // 👤 Izohni kim yozgan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // 🧩 Qaysi postga tegishli
            $table->foreignId('post_id')->constrained()->onDelete('cascade');

            // 👤 Qaysi user yozgan
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->text('comment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

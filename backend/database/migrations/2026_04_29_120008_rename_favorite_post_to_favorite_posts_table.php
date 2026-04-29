<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('favorite_post', 'favorite_posts');
    }

    public function down(): void
    {
        Schema::rename('favorite_posts', 'favorite_post');
    }
};

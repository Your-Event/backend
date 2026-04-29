<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_sub_types_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lang_id')->constrained('languages')->cascadeOnDelete();
            $table->foreignId('post_sub_type_id')->constrained('post_sub_types')->cascadeOnDelete();
            $table->string('title');
            $table->timestamps();

            $table->unique(['lang_id', 'post_sub_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_sub_types_translations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lang_id')->constrained('languages')->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->string('title');
            $table->timestamps();

            $table->unique(['lang_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_translations');
    }
};

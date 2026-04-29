<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['price_unit_id']);
        });

        Schema::rename('price_units', 'post_units');

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('price_unit_id')
                ->references('id')
                ->on('post_units')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['price_unit_id']);
        });

        Schema::rename('post_units', 'price_units');

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('price_unit_id')
                ->references('id')
                ->on('price_units')
                ->cascadeOnDelete();
        });
    }
};

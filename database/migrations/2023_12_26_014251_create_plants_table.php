<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->char('mac_address', 17)->primary();
            $table->decimal('min_temperature', 8, 4);
            $table->decimal('min_humidity', 8, 4);
            $table->decimal('min_soil_humidity', 8, 4);
            $table->decimal('max_temperature', 8, 4);
            $table->decimal('max_humidity', 8, 4);
            $table->decimal('max_soil_humidity', 8, 4);
            $table->boolean('is_want_remind')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('theme_component_attribute', function (Blueprint $table) {
            $table->foreignId('theme_component_id')
                ->constrained();
            $table->foreignId('component_attribute_id')
                ->constrained();
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_component_attribute');
    }
};

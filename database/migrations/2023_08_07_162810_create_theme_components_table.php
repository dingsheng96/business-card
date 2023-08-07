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
        Schema::create('theme_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theme_id')
                ->constrained();
            $table->unsignedInteger('type')
                ->comment('0:background, 1:button, 2:font');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_components');
    }
};

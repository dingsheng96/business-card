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
        Schema::create('user_visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained();
            $table->string('ip_address');
            $table->string('location');
            $table->string('timezone');
            $table->decimal('latitude', 10, 8)->default(0);
            $table->decimal('longitude', 11, 8)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_visitor_logs');
    }
};

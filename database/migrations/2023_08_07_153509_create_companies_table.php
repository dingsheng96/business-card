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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained();
            $table->string('name');
            $table->unsignedInteger('status')
                ->comment('0:inactive, 1:active')
                ->index();
            $table->string('website')->nullable();
            $table->boolean('is_external')
                ->default(false)
                ->comment('external website url');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

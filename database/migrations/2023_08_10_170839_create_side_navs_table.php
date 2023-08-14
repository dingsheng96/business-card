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
        Schema::create('side_navs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('side_navs');
            $table->string('guard_name');
            $table->string('icon')
                ->nullable();
            $table->unsignedTinyInteger('route_type')
                ->comment('0:full url, 1: route name')
                ->default(0);
            $table->string('route')
                ->default('#');
            $table->json('route_param')
                ->nullable();
            $table->unsignedTinyInteger('active_type')
                ->comment('0:resources, 1: routes')
                ->nullable();
            $table->json('active_param')
                ->nullable();
            $table->unsignedInteger('sort')
                ->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name', 'guard_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('side_navs');
    }
};

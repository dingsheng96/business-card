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
        Schema::table('activity_log', function (Blueprint $table) {
            $table->unsignedTinyInteger('environment')
                ->comment('1:production,2:localhost,3:staging');
            $table->string('host');
            $table->string('path');
            $table->string('ip_address');
            $table->string('location')->nullable()->index();
            $table->json('trackers')->nullable();
            $table->text('user_agent');

            $table->index(['host', 'path']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->dropIndex(['host', 'path']);

            $table->dropColumn(['host', 'path', 'user_agent', 'ip_address', 'location', 'trackers']);
        });
    }
};

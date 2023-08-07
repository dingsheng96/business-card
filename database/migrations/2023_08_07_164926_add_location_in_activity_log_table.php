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
            $table->string('guard')->index();
            $table->string('host');
            $table->string('path');
            $table->text('user_agent');
            $table->string('ip_address');
            $table->string('location')->nullable();
            $table->json('trackers')->nullable();

            $table->index(['host', 'path'], 'full_url_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->dropIndex(['host', 'path']);
            $table->dropIndex(['guard']);

            $table->dropColumn(['guard', 'host', 'path', 'user_agent', 'ip_address', 'location', 'trackers']);
        });
    }
};

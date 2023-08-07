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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('mediable');
            $table->unsignedInteger('usage')->comment('purpose of using, example: profile image, background image,etc...')->index();
            $table->string('ori_name');
            $table->string('hashed_name');
            $table->string('extension');
            $table->string('store_path');
            $table->string('mime_type')->index();
            $table->unsignedInteger('size')->default(0)->comment('in bytes')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['store_path', 'hashed_name', 'extension'], 'full_store_path_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};

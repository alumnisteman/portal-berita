<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This migration ensures the iklans table exists even if the original
     * migration record was logged but the table was never actually created.
     */
    public function up(): void
    {
        if (!Schema::hasTable('iklans')) {
            Schema::create('iklans', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('image_path');
                $table->string('url_link')->nullable();
                $table->enum('position', [
                    'top_leaderboard',
                    'sidebar_square',
                    'in_feed_native',
                    'article_interruption',
                    'interstitial',
                    'wallpaper'
                ])->default('top_leaderboard');
                $table->boolean('is_active')->default(true);
                $table->timestamp('expires_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iklans');
    }
};

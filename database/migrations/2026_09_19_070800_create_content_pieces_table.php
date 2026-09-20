<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_pieces', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // blog, facebook_post, linkedin_post, youtube_script, ...
            $table->string('platform')->nullable(); // facebook, linkedin, youtube, or null for blog
            $table->string('topic')->nullable(); // SEO, Social Media Ads, Lead Generation, Web Design, CRO
            $table->string('title')->nullable();
            $table->longText('body');
            $table->json('metadata')->nullable(); // hashtags, scene cues, etc.
            $table->string('status')->default('draft'); // draft, approved, rejected, published, failed
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('external_post_id')->nullable();
            $table->text('last_error')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['type', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_pieces');
    }
};

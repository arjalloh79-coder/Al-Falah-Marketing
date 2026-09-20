<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('title');
            $table->string('category'); // Web Design, SEO & Ads, AI Automation, E-commerce
            $table->string('target_market'); // e.g., USA, Nigeria, Houston, TX
            $table->string('badge_text'); // e.g., +300% Leads, 50K+ Active Users
            $table->string('year'); // e.g., 2024, 2023
            $table->string('image'); // स्टोर इमेज पाथ या URL
            $table->string('project_url')->nullable(); // रीडायरेक्ट के लिए लिंक
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            //
        });
    }
};

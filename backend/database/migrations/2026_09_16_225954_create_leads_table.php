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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->enum('source', ['contact_form', 'consultation_form', 'email', 'whatsapp'])->default('contact_form');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('business')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('service_interest')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['new', 'replied', 'needs_verification', 'archived_spam'])->default('new');
            $table->string('next_step')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

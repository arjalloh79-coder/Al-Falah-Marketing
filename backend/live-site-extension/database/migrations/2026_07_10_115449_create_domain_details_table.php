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
        Schema::create('domain_details', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('domain_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            // Set up relationship to standard Laravel users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_details');
    }
};

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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_name');
            $table->string('certificate_number')->unique();
            $table->string('event_name');
            $table->date('issued_date');
            $table->date('expiry_date')->nullable();
            $table->foreignId('template_id')->constrained('templates')->onDelete('cascade');
            $table->enum('status', ['active', 'revoked'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};

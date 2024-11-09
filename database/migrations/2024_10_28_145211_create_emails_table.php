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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to users table
            $table->string('recipient_name');
            $table->string('recipient_email');
            $table->string('cc_email')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->enum('status', ['draft', 'sent', 'scheduled', 'failed'])->default('draft');
            $table->json('attachments')->nullable(); // Stores file paths for attachments
            $table->timestamps();
            $table->timestamp('sent_at')->nullable(); // Timestamp for when the email was sent
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
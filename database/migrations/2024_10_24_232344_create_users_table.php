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
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Unique identifier
            $table->string('name');  // User's name
            $table->string('username')->unique();  // User's username (must be unique)
            $table->string('email')->unique();  // Unique email address
            $table->timestamp('email_verified_at')->nullable();  // Timestamp for email verification
            $table->string('password');  // User's hashed password
            $table->rememberToken();  // Token for "Remember Me" functionality
            $table->string('photo')->nullable();  // User's profile photo (nullable)
            $table->string('phone')->nullable();  // User's phone number (nullable)
            $table->text('address')->nullable();  // User's address (nullable)
            $table->enum('role', ['admin', 'agent', 'user'])->default('user');  // User's role
            $table->boolean('status')->default(true);  // User's status (active by default)
            $table->softDeletes();  // Adds a deleted_at column for soft deletes
            $table->timestamps();  // Automatically adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');  // Drop the users table if it exists
    }
};
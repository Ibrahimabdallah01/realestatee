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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable();     // Add a new 'username' column
            $table->string('photo')->nullable();        // Add a new 'photo' column
            $table->string('phone')->nullable();        // Add a new 'phone' column
            $table->text('address')->nullable();        // Add a new 'address' column

            // Use ENUM for 'role' column with the values 'admin', 'agent', 'user'
            $table->enum('role', ['admin', 'agent', 'user'])->default('user');

            // Use ENUM for 'status' column with the values 'active' and 'inactive'
            $table->enum('status', ['active', 'inactive'])->default('active');

            // Add 'deleted_at' column for soft deletes
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the added columns
            $table->dropColumn(['username', 'photo', 'phone', 'address', 'role', 'status']);

            // Drop the 'deleted_at' column for soft deletes
            $table->dropSoftDeletes();
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Department: optional text
            $table->string('department', 255)->nullable()->after('email');

            // Status: active / inactive, default active
            $table->string('status', 20)->default('active')->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['department', 'status']);
        });
    }
};

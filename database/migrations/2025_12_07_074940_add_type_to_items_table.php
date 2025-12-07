<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('items', function (Blueprint $table) {
        
        $table->string('type')->default('found')->after('name'); 
        
        
        $table->text('description')->nullable()->after('category'); 
        $table->string('reporter_email')->nullable()->after('owner_id');
        $table->string('category')->nullable()->after('name');
    });
}

public function down(): void
{
    Schema::table('items', function (Blueprint $table) {
        $table->dropColumn(['type', 'category', 'description', 'reporter_email']);
    });
}
};

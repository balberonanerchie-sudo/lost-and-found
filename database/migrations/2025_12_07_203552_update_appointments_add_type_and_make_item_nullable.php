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
        Schema::table('appointments', function (Blueprint $table) {
            // Add "type" column after item_id: 'claim' or 'turnover'
            $table->string('type')
                  ->default('claim')
                  ->after('item_id');

            // Make item_id nullable and set null on delete
            // Step 1: drop existing foreign key
            $table->dropForeign(['item_id']);

            // Step 2: change column to nullable
            $table->unsignedBigInteger('item_id')->nullable()->change();

            // Step 3: re-add foreign key with nullOnDelete()
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->nullOnDelete(); // equivalent to onDelete('set null')
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop modified foreign key
            $table->dropForeign(['item_id']);

            // Make item_id required again
            $table->unsignedBigInteger('item_id')->nullable(false)->change();

            // Restore original FK behavior (cascade delete)
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('cascade');

            // Drop the "type" column
            $table->dropColumn('type');
        });
    }
};

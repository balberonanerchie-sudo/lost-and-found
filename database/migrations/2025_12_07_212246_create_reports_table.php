<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            // Who submitted the report (optional, in case of guests)
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // lost / found
            $table->string('type');

            $table->string('item_name');
            $table->string('category')->nullable();
            $table->text('description')->nullable();

            $table->string('location')->nullable();
            $table->date('incident_date')->nullable();

            // Stored path of uploaded image
            $table->string('image_path')->nullable();

            // Contact email (may or may not match auth user)
            $table->string('contact_email')->nullable();

            // new, linked, closed, etc. (for later admin workflows)
            $table->string('status')->default('new');

            // Optional link to an Item later
            $table->foreignId('item_id')
                ->nullable()
                ->constrained('items')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

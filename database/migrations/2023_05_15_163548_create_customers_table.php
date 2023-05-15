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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->enum('title', ['Mr', 'Mrs', 'Miss', 'Dr']);
            $table->string('fname');
            $table->string('lname');
            $table->string('contact')->unique();
            $table->integer('district_id');
            $table->integer('add_by');
            $table->integer('edit_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

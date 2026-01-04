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
        Schema::create('generated_passwords', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            $table->text('password_encrypted');
            $table->integer('length');
            $table->boolean('has_uppercase')->default(true);
            $table->boolean('has_lowercase')->default(true);
            $table->boolean('has_numbers')->default(true);
            $table->boolean('has_symbols')->default(true);
            $table->boolean('was_used')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generated_passwords');
    }
};

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
        Schema::create('passwords', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vault_id')->nullable()->constrained()->nullOnDelete();
            
            $table->string('title');
            $table->string('username')->nullable();
            $table->text('password_encrypted');
            $table->string('url')->nullable();
            $table->text('notes')->nullable();
            
            $table->boolean('is_favorite')->default(false);
            $table->timestamp('last_used_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['user_id', 'vault_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passwords');
    }
};
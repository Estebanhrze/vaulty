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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // FKs
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('account_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('transfer_account_id')->nullable()->constrained('accounts')->nullOnDelete();

            // Datos principales
            $table->enum('type', ['income', 'expense', 'transfer']);
            $table->decimal('amount', 12, 2);
            $table->date('date');
            $table->text('description')->nullable();

            // Soft delete + timestamps
            $table->softDeletes();
            $table->timestamps();

            // Índices útiles
            $table->index(['user_id', 'date']);
            $table->index(['account_id', 'date']);
            $table->index('category_id');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

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

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Link to categories
            $table->decimal('amount', 10, 1); // Amount for the transaction
            $table->text('description')->nullable(); // Optional transaction description
            $table->date('date'); // Transaction date
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid'); // Udhaar status: unpaid, paid
            

            $table->timestamps();
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

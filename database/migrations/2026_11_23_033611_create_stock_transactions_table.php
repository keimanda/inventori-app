<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_id')
                ->constrained('items')
                ->cascadeOnDelete();

            $table->string('transaction_type', 10);
            $table->unsignedInteger('quantity');
            $table->dateTime('transaction_date');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};

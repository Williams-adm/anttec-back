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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['inflow', 'outflow']);
            $table->string('detail_transaction');
            $table->unsignedInteger('quantity');

            $table->foreignId('branch_variant_id')->constrained(table: 'branch_variant', indexName: 'branch_variant_id')
                ->cascadeOnDelete()->cascadeOnUpdate();
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};

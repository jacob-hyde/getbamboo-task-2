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
        // We create some generic columns.
        // A real world implementation could be much different in the data sent to the state regulators.
        Schema::create('sales', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uuid')->unique(); // Use UUID's to send to state regulator providers
            $table->string('state');
            $table->string('strain');
            $table->integer('quantity');
            $table->string('unit');
            $table->string('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

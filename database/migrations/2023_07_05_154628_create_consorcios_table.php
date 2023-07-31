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
        Schema::create('consorcios', function (Blueprint $table) {
            $table->id();
            $table->string('ruc');
            $table->string('razonsocial');
            $table->string('cuentacorriente');
            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('monto', 9,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consorcios');
    }
};

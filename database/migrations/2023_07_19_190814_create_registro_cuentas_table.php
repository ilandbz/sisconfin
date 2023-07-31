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
        Schema::create('registro_cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('obra');
            $table->string('tipo');  //INGRESO O GASTO A LA OBRA
            $table->string('medioentrega')->default('EFECTIVO');//DEPOSITO O EFECTIVO
            $table->string('nro_operacion')->nullable();
            $table->string('nrocomprobante')->nullable();
            $table->tinyInteger('tiene_igv')->unsigned()->default(1);
            $table->foreignId('banco_id')->nullable()->constrained('bancos')->onDelete('cascade')->onUpdate('cascade');
            $table->char('ruc_dni',11)->nullable();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('monto',9,2);
            $table->decimal('detraccion',9,2);
            $table->string('moneda')->default('SOLES');
            $table->decimal('saldo',11,2);
            $table->string('uso')->default('NINGUNO');
            $table->string('observacion')->default('NINGUNO');
            $table->string('concepto');
            $table->datetime('fecha_hora');
            $table->string('estado');
            $table->string('origen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_cuentas');
    }
};

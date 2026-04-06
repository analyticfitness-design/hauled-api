<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encargos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('marca');
            $table->string('producto');
            $table->string('talla')->nullable();
            $table->string('color')->nullable();
            $table->string('link_referencia')->nullable();
            $table->unsignedBigInteger('presupuesto')->nullable(); // centavos COP
            $table->unsignedBigInteger('anticipo')->nullable();
            $table->enum('status', ['recibido','cotizando','aprobado','en_camino','listo','entregado'])->default('recibido');
            $table->text('notas_cliente')->nullable();
            $table->text('notas_admin')->nullable();
            $table->text('wa_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encargos');
    }
};

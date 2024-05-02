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
        Schema::create('ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('numero_ticket', 10)->unique()->default('T-00001');
            $table->date('fecha');
            $table->time('hora');
            $table->string('lugar');
            $table->integer('cantidad_de_tickets');
            $table->timestamps();
        });

        Schema::create('detalle_ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('ticket')->onDelete('cascade');
            $table->string('titulo');
            $table->string('organizacion');
            $table->string('destinatario');
            $table->string('agradecimiento');
            $table->decimal('monto_de_colaboracion', 10, 2);
            $table->string('estado_de_pago', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ticket');
        Schema::dropIfExists('ticket');
    }
};

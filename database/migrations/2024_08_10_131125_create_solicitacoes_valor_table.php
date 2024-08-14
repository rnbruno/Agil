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
        Schema::create('solicitacoes_valor', function (Blueprint $table) {
            $table->id();
            $table->integer('from_account_id');
            $table->integer('to_account_id');
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['pendente', 'completada', 'cancelada']);
            $table->text('notes')->nullable(); // Notas ou observações
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes_valor');
    }
};

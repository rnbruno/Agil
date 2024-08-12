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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relaciona com a tabela de usuários
            $table->decimal('amount', 15, 2); // Valor solicitado
            $table->string('currency', 3)->default('BRL'); // Moeda (ex: BRL, USD)
            $table->string('status')->default('pending'); // Status da solicitação (ex: pending, approved, rejected)
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

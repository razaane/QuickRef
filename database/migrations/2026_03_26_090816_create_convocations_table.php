<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('convocations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('match_id')
               ->constrained('matchs')->onDelete('cascade');
        $table->foreignId('arbitre_central_id')
               ->constrained('arbitres')->onDelete('cascade');
        $table->foreignId('arbitre_assistant1_id')
               ->constrained('arbitres')->onDelete('cascade');
        $table->foreignId('arbitre_assistant2_id')
               ->constrained('arbitres')->onDelete('cascade');
        $table->enum('statut', ['envoyee', 'confirmee', 'annulee'])
               ->default('envoyee');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convocations');
    }
};

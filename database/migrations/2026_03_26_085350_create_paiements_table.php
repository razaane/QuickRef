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
    Schema::create('paiements', function (Blueprint $table) {
        $table->id();
        $table->foreignId('arbitre_id')
               ->constrained('arbitres')->onDelete('cascade');
        $table->decimal('montant', 10, 2);
        $table->string('mois');
        $table->string('statut')->default('en_attente');
        $table->date('date_paiement')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matchs', function (Blueprint $table) {
        // Ila bghiti t-raj3ih ENUM
        $table->enum('statut', ['en_attente', 'jouer', 'annuler'])->default('en_attente')->change();
    });
    }
};

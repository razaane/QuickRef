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
    Schema::create('feuilles_match', function (Blueprint $table) {
        $table->id();
        $table->foreignId('match_id')
               ->constrained('matchs')->onDelete('cascade');
        $table->foreignId('arbitre_id')       // arbitre central
               ->constrained('arbitres')->onDelete('cascade');
        $table->string('fichier_path');       // chemin du PDF
        $table->enum('statut', ['soumise', 'verifiee', 'rejetee'])
               ->default('soumise');
        $table->text('commentaire_admin')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feuilles_match');
    }
};

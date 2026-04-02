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
    Schema::create('matchs', function (Blueprint $table) {
    $table->id();
    //equipes
    $table->foreignId('equipe_domicile_id')->constrained('equipes')->onDelete('cascade');
    $table->foreignId('equipe_visiteur_id')->constrained('equipes')->onDelete('cascade');
    $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');

    //Arbitres
    $table->foreignId('arbitre_central_id')->constrained('arbitres');
    $table->foreignId('arbitre_assistant1_id')->constrained('arbitres');
    $table->foreignId('arbitre_assistant2_id')->constrained('arbitres');
    $table->foreignId('quatrieme_arbitre_id')->nullable()->constrained('arbitres');

    //date et day
    $table->dateTime('date_heure'); 
    $table->string('terrain');
    $table->string('ville');

    //Statut 
    $table->enum('statut', [
    'en_attente',   
    'confirmer',     
    'jouer',         
    'annuler',       
    'reporter'      
    ])->default('en_attente');
    
    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchs');
    }
};

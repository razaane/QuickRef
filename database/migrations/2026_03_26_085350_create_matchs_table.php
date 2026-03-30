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
        $table->foreignId('equipe_domicile_id')
               ->constrained('equipes')->onDelete('cascade');
        $table->foreignId('equipe_visiteur_id')
               ->constrained('equipes')->onDelete('cascade');
        $table->foreignId('categorie_id')
               ->constrained('categories')->onDelete('cascade');
        $table->dateTime('date');
        $table->string('terrain');
        $table->string('ville');
        $table->enum('statut', ['programme', 'joue', 'annule'])
               ->default('programme');
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

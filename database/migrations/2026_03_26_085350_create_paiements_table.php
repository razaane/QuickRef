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
        $table->integer('nombre_matchs');
        $table->decimal('montant_total', 10, 2);
        $table->enum('statut', ['non_paye', 'paye'])->default('non_paye');
        $table->timestamp('date_validation')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};

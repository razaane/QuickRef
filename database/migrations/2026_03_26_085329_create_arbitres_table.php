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
    Schema::create('arbitres', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')
               ->constrained('users')
               ->onDelete('cascade');
        $table->string('telephone');
        $table->enum('grade', [
            'regional',
            'national', 
            'international'
        ]);
        $table->string('adresse')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arbitres');
    }
};

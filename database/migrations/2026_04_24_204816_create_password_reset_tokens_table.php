<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();   // email ديال user
            $table->string('token');              // token reset
            $table->timestamp('created_at')->nullable(); // وقت الإنشاء
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
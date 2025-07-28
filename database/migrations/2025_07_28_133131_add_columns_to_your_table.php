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
        Schema::table('tasks', function (Blueprint $table) {
            // Добавьте ваши поля здесь
            $table->integer('quantity')->default(0);
            $table->float('price')->default(0);
            $table->foreignId('executor_user_id')->index()->constrained('users')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Удалите поля здесь (в обратном порядке!)
            $table->dropColumn('executor_user_id');
            $table->dropColumn('price');
            $table->dropColumn('quantity');
        });
    }
};

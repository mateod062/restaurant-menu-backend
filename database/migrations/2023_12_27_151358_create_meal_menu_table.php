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
        Schema::create('meal_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soup_id')->constrained('meals')->onDelete('cascade');
            $table->foreignId('main_meal_id')->constrained('meals')->onDelete('cascade');
            $table->foreignId('side_dish_id')->constrained('meals')->onDelete('cascade');
            $table->foreignId('dessert_id')->constrained('meals')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_menu');
    }
};

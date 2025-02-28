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
        Schema::create('professor_speciality', function (Blueprint $table) {
            $table->foreignId('professor_id')
                ->constrained('users','id')
                ->onDelete('cascade');
            
            $table->foreignId('speciality_id')
                ->constrained('specialities')
                ->onDelete('cascade');
            $table->timestamps();

            $table->primary(['professor_id', 'speciality_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professor_speciality');
    }
};

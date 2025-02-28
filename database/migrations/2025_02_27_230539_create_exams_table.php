<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')
                ->constrained('users', 'id');

            $table->string('title');
            $table->longText('description');
            $table->binary('file');
            $table->date('deadline');
            $table->timestamps();

            DB::statement('ALTER TABLE exams ADD CONSTRAINT check_is_professor check ((select role from users where id = author_id) = professor)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};

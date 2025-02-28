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
        Schema::create('courses_assignments', function (Blueprint $table) {
            $table->foreignId('professor_id')
                ->constrained('users', 'id')
                ->onDelete('cascade');

            $table->string('course_code');
            $table->foreign('course_code')
                ->references('code')
                ->on('courses')
                ->onDelete('cascade');

            $table->timestamps();

            $table->primary(['professor_id', 'course_code']);

            DB::statement('ALTER TABLE courses_assignments ADD CONSTRAINT check_is_professor check ((select role from users where id = professor_id) = professor)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_assignments');
    }
};

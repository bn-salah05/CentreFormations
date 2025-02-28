<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrolments', function (Blueprint $table) {
            $table->foreignId('student_id')
                ->constrained('users', 'id')
                ->onDelete('cascade');

            $table->string('course_code');
            $table->foreign('course_code')
                ->references('code')
                ->on('courses')
                ->onDelete('cascade');
            $table->timestamps();

            $table->primary(['student_id', 'course_code']);

            DB::statement('ALTER TABLE enrolments ADD CONSTRAINT check_is_student check ((select role from users where id = student_id) = student)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrolments');
    }
};

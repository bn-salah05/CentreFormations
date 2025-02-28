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
        Schema::create('assignment_submissions', function (Blueprint $table) {

            $table->foreignId('student_id')
                ->constrained('users', 'id')
                ->onDelete('cascade');
        
            $table->foreignId('exam_id')
                ->constrained('exams')
                ->onDelete('cascade');

            $table->timestamps();

            $table->primary(['student_id', 'exam_id']);

            DB::statement('ALTER TABLE assignment_submissions ADD CONSTRAINT check_is_student check ((select role from users where id = student_id) = student)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_submissions');
    }
};

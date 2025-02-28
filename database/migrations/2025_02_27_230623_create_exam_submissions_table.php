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
        Schema::create('exam_submissions', function (Blueprint $table) {
            $table->id();

            $table->binary('exam_file');
            $table->decimal('note', 4, 2);
            $table->text('professor_comment');

            $table->foreignId('student_id')
                ->constrained('users', 'id');
            $table->string('course_code');
            $table->foreign('course_code')
                ->references('code')
                ->on('courses')
                ->onDelete('cascade');
            $table->timestamps();

            DB::statement('ALTER TABLE exam_submissions MODIFY exam_file LONGBLOB');

            db::statement('ALTER TABLE exam_submissions ADD CONSTRAINT check_note check (note >=0 AND note <= 20)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_submissions');
    }
};

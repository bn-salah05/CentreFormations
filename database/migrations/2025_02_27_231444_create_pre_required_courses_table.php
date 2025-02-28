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
        Schema::create('pre_required_courses', function (Blueprint $table) {

            $table->string('course_code');
            $table->foreign('course_code')
                ->references('code')
                ->on('courses')
                ->onDelete('cascade');
            
            $table->string('pre_required_course_code');
            $table->foreign('pre_required_course_code')
                ->references('code')
                ->on('courses')
                ->onDelete('cascade');

            $table->timestamps();

            DB::statement('ALTER TABLE pre_required_courses ADD CONSTRAINT checkUnicity check (course_code <> pre_required_course_code)');

            $table->primary(['course_code', 'pre_required_course_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_required_courses');
    }
};

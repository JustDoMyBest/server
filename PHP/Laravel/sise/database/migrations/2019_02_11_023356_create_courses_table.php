<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            // $table->unsignedInteger('course_type_id');
            $table->unsignedInteger('coursetype_id');
            $table->unsignedInteger('tag_id');
            $table->boolean('enabled')->default(false);
            $table->string('title');
            $table->text('description');
            $table->integer('like');
            $table->integer('dislike');
            $table->timestamps();
            // $table->unique(['user_id','course_type_id']);
            $table->unique(['user_id','coursetype_id']);

            // $table->foreign('course_type_id')
            $table->foreign('coursetype_id')
            ->references('id')
            ->on('course_types')
            ->onDelete('cascade');

            // $table->foreign('tag_id')
            // ->references('id')
            // ->on('tags')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}

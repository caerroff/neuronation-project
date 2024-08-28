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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('domainCategories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('name');
        });

        Schema::create('exercises', function (Blueprint $table) {
            $table->id('exercise_id');
            $table->foreignId('course_id')->constrained('courses', 'course_id')->cascadeOnDelete();
            $table->foreignId('cat_id')->constrained('domainCategories', 'category_id')->cascadeOnDelete();
            $table->string('name');
            $table->integer('points');
        });

        Schema::create('training_sessions', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
            $table->string('category_name');
            $table->foreignId('course_id')->constrained('courses', 'course_id')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('domainCategories', 'category_id')->cascadeOnDelete();
        });

        Schema::create('users', function(Blueprint $table) {
            $table->id('user_id');
            $table->string('username');
            $table->string('password');
            $table->smallInteger('status')->default(0);
            $table->unique('username');
        });

        Schema::create('scores', function(Blueprint $table) {
            $table->id('score_id');
            $table->foreignId('sid')->constrained('training_sessions', 'id')->cascadeOnDelete();
            $table->foreignId('uid')->constrained('users', 'user_id')->cascadeOnDelete();
            $table->integer('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('domainCategories');
        Schema::dropIfExists('exercises');
        Schema::dropIfExists('training_sessions');
        Schema::dropIfExists('users');
        Schema::dropIfExists('scores');
    }
};

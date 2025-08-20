<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained('chapters')->onDelete('cascade');
            $table->longText('question_text')->nullable(); // text/table HTML
            $table->string('question_image')->nullable();  // image path
            $table->longText('derived_question')->nullable();
            $table->string('video_url')->nullable();
            $table->longText('correct_option_reasoning')->nullable();
            $table->longText('reference_text')->nullable();
            $table->enum('level', ['easy', 'medium', 'hard']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcqs');
    }
};

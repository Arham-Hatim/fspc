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
        Schema::create('mcq_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mcq_id')->constrained('mcqs')->onDelete('cascade');
            $table->unsignedTinyInteger('position'); // Option order
            $table->string('option', 500)->nullable(); // allow long option text
            $table->boolean('is_correct')->default(0); // flag for correct answer
            $table->longText('option_explanation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcq_options');
    }
};

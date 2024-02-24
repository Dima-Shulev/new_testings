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
            Schema::create('questions', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('metaKey')->default(null);
                $table->string('metaDescription')->default(null);
                $table->text('trueAnswers');
                $table->text('falseAnswers');
                $table->text('allAnswers');
                $table->text('description')->default(null);
                $table->unsignedBigInteger('testing_id');
                $table->foreign('testing_id')->references('id')->on('testings');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

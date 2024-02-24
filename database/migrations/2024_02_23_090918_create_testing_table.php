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
        Schema::create('testings', function (Blueprint $table) {
            $table->id();
            $table->string('name_test');
            $table->text('content');
            $table->string('passing_score');
            $table->string('metaKey')->default(null);
            $table->string('metaDescription')->default(null);
            $table->integer("time")->default(0);
            $table->dateTime('created_at')->default(date("Y-m-d H:i:s"));
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testings');
    }
};

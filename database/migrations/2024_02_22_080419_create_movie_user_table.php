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
        Schema::create('movie_user', function (Blueprint $table) {
            // id:
            $table->id();

            // other:
            // $table->foreignUuid('movie_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('movie_id')->references('id')->on('movies')->onDelete('cascade');
            // $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');

            // timestamps:
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_user');
    }
};
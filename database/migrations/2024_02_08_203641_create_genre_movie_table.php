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
        Schema::create('genre_movie', function (Blueprint $table) {
            // id:
            $table->id();

            // other:
            // $table->foreignUuid('genre_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('genre_id')->references('id')->on('genres')->onDelete('cascade');
            // $table->foreignUuid('movie_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('movie_id')->references('id')->on('movies')->onDelete('cascade');

            // timestamps:
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_movie');
    }
};

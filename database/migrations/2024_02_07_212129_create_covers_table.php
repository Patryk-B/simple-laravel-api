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
        Schema::create('covers', function (Blueprint $table) {
            // uuid id:
            $table->uuid('id')->primary(); // use either foreignId:
                                           // - $table->foreignId('movie_covers_id')->constrained();
                                           // - $table->foreignId('foooooooooooooo')->references('id')->on('movie_covers');

            // other:
            $table->foreignUuid('movie_id')->references('id')->on('movies');

            // timestamps:
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('covers');
    }
};

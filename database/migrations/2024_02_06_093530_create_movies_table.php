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
        Schema::create('movies', function (Blueprint $table) {
            // uuid:
            $table->uuid('id')->primary(); // use either foreignId:
                                           // - $table->foreignId('movie_id')->constrained();
                                           // - $table->foreignId('fooooooo')->references('id')->on('movies');

            // other:
            $table->string('title');
            $table->string('cover');
            $table->string('country');
            $table->longText('description');
            $table->foreignUuid('uploaded_by')->references('id')->on('users');

            // timestamps:
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};

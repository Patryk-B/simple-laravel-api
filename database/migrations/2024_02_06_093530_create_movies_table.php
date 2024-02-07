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
            // uuid id:
            $table->uuid('id')->primary(); // use either foreignId:
                                           // - $table->foreignId('movie_id')->constrained();
                                           // - $table->foreignId('fooooooo')->references('id')->on('movies');

            // other:
            $table->string('title');
            // $table->foreignUuid('cover')->references('id')->on('movie_covers')->nullable();
            // $table->string('cover_uuid')->nullable();
            $table->json('genres');
            $table->string('country');
            $table->longText('description');
            $table->foreignUuid('uploaded_by')->nullable()->references('id')->on('users');

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

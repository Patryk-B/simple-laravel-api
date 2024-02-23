<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Genre;
use App\Models\Movie;
use App\Helpers\ValidGenres;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\Api\V1\MovieController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MovieTest extends TestCase
{
    use DatabaseMigrations;

    // ---- . ---- ---- ---- ---- . ----
    // helper functions:
    // ---- . ---- ---- ---- ---- . ----

    // /**
    //  * generate $user & $movie
    //  */
    // protected function genFakeData()
    // {
    //     // // gen valid users:
    //     // $users = User::factory()
    //     //     ->count(10)
    //     //     ->create();
    //
    //     // get valid genres:
    //     $genres = Genre::all();
    //
    //     // gen valid movies:
    //     $movies = Movie::factory()
    //         ->count(50)
    //         ->create();
    //
    //     // attach user and genres:
    //     foreach ($movies as $movie) {
    //         // $randomUserUUID = $users->random(1)->first()->id;
    //         $randomGenreUUIDs = $genres->random(rand(1, 3))->pluck('id');
    //
    //
    //         // $movie->update(['uploaded_by' => $randomUserUUID]);
    //         $movie->genres()->attach($randomGenreUUIDs);
    //     };
    //
    //     // exit:
    //     return (object)[
    //         // 'users' => $users,
    //         'movies' => $movies
    //     ];
    // }

    // ---- . ---- ---- ---- ---- . ----
    // hooks:
    // ---- . ---- ---- ---- ---- . ----

    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        // seed the database:
        $this->seed();
    }

    // ---- . ---- ---- ---- ---- . ----
    // tests:
    // ---- . ---- ---- ---- ---- . ----

    /**
     * A basic test example.
     */
    public function test_movie_model_relations(): void
    {
        // test data:
        $movies = Movie::all();
        $randomMovie = $movies->random(1)->first();
        $randomMovieGenresName = $randomMovie->genres->pluck('name')->toArray();
        $randomMovieUploadedByUserUUID = $randomMovie->uploadedByUser->id;
        $randomMovieLikedByUsersUUID = $randomMovie->likedByUsers->pluck('id')->toArray();

        // valid data:
        $ValidGenresName = ValidGenres::get();

        // test `genres` relation (many-to-many):
        foreach ($randomMovieGenresName as $genresName) {
            $this->assertContains($genresName, $ValidGenresName);
        };

        // // error:
        // $this->assertTrue(false);
    }

    // /**
    //  * A basic test example.
    //  */
    // public function test_foo(): void
    // {
    //     $fakeData = MovieTest::genFakeData();
    //     $movie = $fakeData->movie;
    //
    //     $response = $this->getJson('/api/v1/movies/'.$movie->id);
    //
    //     $response->assertStatus(200);
    // }
}

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

class MovieModelTest extends TestCase
{
    use DatabaseMigrations;

    // ---- . ---- ---- ---- ---- . ----
    // helper functions:
    // ---- . ---- ---- ---- ---- . ----

    /**
     *
     */
    protected function get_movies()
    {
        return Movie::all();
    }

    /**
     *
     */
    protected function get_randomMovie()
    {
        $movies = MovieModelTest::get_movies();
        return $movies->random(1)->first();
    }

    /**
     *
     */
    protected function get_genres(Movie $movie)
    {
        return $movie->genres;
    }

    /**
     *
     */
    protected function get_genres_names(Movie $movie)
    {
        $genres = MovieModelTest::get_genres($movie);
        return $genres->pluck('name')->toArray();
    }

    /**
     *
     */
    protected function get_uploadedByUser(Movie $movie)
    {
        return $movie->uploadedByUser;
    }

    /**
     *
     */
    protected function get_uploadedByUser_uuid(Movie $movie)
    {
        $uploadedByUser = MovieModelTest::get_uploadedByUser($movie);
        return $uploadedByUser->id;
    }

    /**
     *
     */
    protected function get_likedByUsers(Movie $movie)
    {
        return $movie->likedByUsers;
    }

    /**
     *
     */
    protected function get_likedByUsers_uuids(Movie $movie)
    {
        $likedByUsers = MovieModelTest::get_likedByUsers($movie);
        return $likedByUsers->pluck('id')->toArray();
    }

    // ---- . ---- ---- ---- ---- . ----
    // hooks:
    // ---- . ---- ---- ---- ---- . ----

    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        // seeds the `testing` database, with fake data via `Model::factory()` methods:
        $this->seed();
    }

    // ---- . ---- ---- ---- ---- . ----
    // tests:
    // ---- . ---- ---- ---- ---- . ----

    /**
     * Test `$movie->genres` relation:
     */
    public function test_Movie_genres(): void
    {
        $validGenres_names = ValidGenres::get();

        // iterate over every `movie` in the testing database:
        $movies = MovieModelTest::get_movies();
        foreach ($movies as $movie) {
            // iterate over every `genre` in the `movie->genres`:
            $genres_names = MovieModelTest::get_genres_names($movie);
            foreach ($genres_names as $genre_name) {

                // test if `validGenres_names` contains `genre_name`:
                $this->assertContains($genre_name, $validGenres_names);
            };
        }
    }

    /**
     * Test `$movie->uploadedByUser` relation:
     */
    public function test_Movie_uploadedByUser(): void
    {
        // valid uuids of all :
        $validUsers_uuids = User::all()->pluck('id')->toArray();

        // iterate over every `movie` in the testing database:
        $movies = MovieModelTest::get_movies();
        foreach ($movies as $movie) {
            // get `uuid` from `movie->uploadedByUser`:
            $uploadedByUser_uuid = MovieModelTest::get_uploadedByUser_uuid($movie);

            // test if `validUsers_uuids` contains `uploadedByUser_uuid`:
            $this->assertContains($uploadedByUser_uuid, $validUsers_uuids);
        }
    }

    /**
     * Test `$movie->likedByUsers` relation:
     */
    public function test_Movie_likedByUsers(): void
    {
        // valid user uuids:
        $validUsers_uuids = User::all()->pluck('id')->toArray();

        // iterate over every `movie` in the testing database:
        $movies = MovieModelTest::get_movies();
        foreach ($movies as $movie) {
            // iterate over every `user` in the `movie->likedByUsers`:
            $likedByUsers_uuids = MovieModelTest::get_likedByUsers_uuids($movie);
            foreach ($likedByUsers_uuids as $likedByUser_uuid) {

                // test if `validUsers_uuids` contains `likedByUser_uuid`:
                $this->assertContains($likedByUser_uuid, $validUsers_uuids);
            }
        }
    }
}

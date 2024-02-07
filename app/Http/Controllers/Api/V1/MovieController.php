<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\V1\MovieQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Resources\V1\MovieResource;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\V1\MovieCollection;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return Movie::all()->map(
        //     fn($movie) => new MovieResource($movie)
        // );

        // return new MovieCollection(Movie::paginate());

        $filer = new MovieQuery();
        $queryItems = $filer->transform($request); // [['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            return new MovieCollection(Movie::paginate());
        } else {
            return new MovieCollection(Movie::where($queryItems)->paginate());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        // WARNING: primary key is `uuid` not `id`. in dev use `localhost:80/api/v1/movies/<uuid>` url to show specific movie.
        return new MovieResource($movie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Filters\V1\MoviesFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MovieResource;
use App\Http\Resources\V1\MovieCollection;
use App\Http\Requests\V1\StoreMovieRequest;
use App\Http\Requests\V1\UpdateMovieRequest;
use App\Http\Requests\V1\BulkStoreMovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filer = new MoviesFilter();
        $filerItems = $filer->transform($request); // [['column', 'operator', 'value']]

        $movies = Movie::where($filerItems); // `Movie::where([])` === `Movie::all()`

        return new MovieCollection($movies->paginate()->appends($request->query()));
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
        return new MovieResource(Movie::create($request->all()));
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
        $movie->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        // $movie->cover()->delete();
        $movie->delete();
        return response()->json(null, 204);
    }
}

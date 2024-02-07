<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\MovieCover;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Filters\V1\MovieCoversFilter;
use App\Http\Requests\V1\StoreMovieCoverRequest;
use App\Http\Resources\V1\MovieCoverResource;
use App\Http\Requests\V1\UpdateMovieCoverRequest;
use App\Http\Resources\V1\MovieCoverCollection;

class MovieCoverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filer = new MovieCoversFilter();
        $filerItems = $filer->transform($request); // [['column', 'operator', 'value']]

        $movieCovers = MovieCover::where($filerItems); // `MovieCover::where([])` === `MovieCover::all()`

        return new MovieCoverCollection($movieCovers->paginate()->appends($request->query()));
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
    public function store(StoreMovieCoverRequest $request)
    {
        return new MovieCoverResource(MovieCover::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(MovieCover $movieCover)
    {
        // WARNING: primary key is `uuid` not `id`. in dev use `localhost:80/api/v1/movies/<uuid>` url to show specific movie cover.
        return new MovieCoverResource($movieCover);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovieCover $movieCover)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieCoverRequest $request, MovieCover $movieCover)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieCover $movieCover)
    {
        //
    }
}

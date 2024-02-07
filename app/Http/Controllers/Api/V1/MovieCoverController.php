<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\MovieCover;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Filters\V1\MovieCoversFilter;
use App\Http\Requests\StoreMovieCoverRequest;
use App\Http\Resources\V1\MovieCoverResource;
use App\Http\Requests\UpdateMovieCoverRequest;
use App\Http\Resources\V1\MovieCoverCollection;

class MovieCoverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filer = new MovieCoversFilter();
        $queryItems = $filer->transform($request); // [['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            return new MovieCoverCollection(MovieCover::paginate());
        } else {
            return new MovieCoverCollection(MovieCover::where($queryItems)->paginate());
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
    public function store(StoreMovieCoverRequest $request)
    {
        //
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

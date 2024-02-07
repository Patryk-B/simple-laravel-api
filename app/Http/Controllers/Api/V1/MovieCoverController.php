<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\MovieCover;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreMovieCoverRequest;
use App\Http\Requests\UpdateMovieCoverRequest;

class MovieCoverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MovieCover::all();
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
        //
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

<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Filters\V1\CoversFilter;
use App\Http\Requests\V1\StoreCoverRequest;
use App\Http\Resources\V1\CoverResource;
use App\Http\Requests\V1\UpdateCoverRequest;
use App\Http\Resources\V1\CoverCollection;

class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filer = new CoversFilter();
        $filerItems = $filer->transform($request); // [['column', 'operator', 'value']]

        $covers = Cover::where($filerItems); // `Cover::where([])` === `Cover::all()`

        return new CoverCollection($covers->paginate()->appends($request->query()));
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
    public function store(StoreCoverRequest $request)
    {
        return new CoverResource(Cover::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cover $cover)
    {
        // WARNING: primary key is `uuid` not `id`. in dev use `localhost:80/api/v1/movies/<uuid>` url to show specific movie cover.
        return new CoverResource($cover);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cover $cover)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoverRequest $request, Cover $cover)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cover $cover)
    {
        //
    }
}

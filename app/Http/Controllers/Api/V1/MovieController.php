<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Genre;
use App\Models\Movie;
use InterventionImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Filters\V1\MoviesFilter;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\V1\MovieResource;
use App\Http\Resources\V1\MovieCollection;
use App\Http\Requests\V1\StoreMovieRequest;
use App\Http\Requests\V1\UpdateMovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filer = new MoviesFilter();
        $filerItems = $filer->transform($request); // [['column', 'operator', 'value']]

        $movies = Movie::where($filerItems);

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
        // Validate request:
        $validated = $request->validated(); // will throw `ValidationException` on invalid data.

        // Create new movie:
        $movie = Movie::create([
            'title' => $validated['title'],
            'cover' => $this->resizeCover($validated['cover']),
            'country' => $validated['country'],
            'description' => $validated['description']
        ]);

        // Parse genres:
        $genres = collect($validated['genres'])->map(
            fn($genre) => Genre::where('name', '=', $genre)->firstOrFail()
        );
        $genreUuids = $genres->pluck('id')->toArray();

        // Attach genres:
        $movie->genres()->attach($genreUuids);

        // Return resource:
        return new MovieResource($movie);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
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
        // Validate request:
        $validated = $request->validated(); // will throw `ValidationException` on invalid data.

        // Update movie:
        $movie->update([
            'title' => $validated['title'] ?? $movie->title,
            'country' => $validated['country'] ?? $movie->country,
            'description' => $validated['description'] ?? $movie->description
        ]);

        // Update cover:
        if ($validated['cover'] ?? null) {
            Storage::delete($movie->cover);
            $movie->update([
               'cover' => $this->resizeCover($validated['cover'])
            ]);
        }

        // Parse genres:
        $genres = collect(
            $validated['genres'] ?? $movie->genres()->get()->pluck('name')
        )->map(
            fn($genre) => Genre::where('name', '=', $genre)->firstOrFail()
        );
        $genreUuids = $genres->pluck('id')->toArray();

        // Update genres (detach old & attach new):
        $movie->genres()->detach();
        $movie->genres()->attach($genreUuids);

        // Return resource:
        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }

    /**
     * resize image before uploading
     */
    public function resizeCover(UploadedFile $file) {
        $width = 500;
        $height = 500;
        $destination = 'cover';
        Storage::makeDirectory($destination, 0755);
        $coverName = Str::orderedUuid().'.'.$file->extension();
        $coverPath = storage_path('app/'.$destination).'/'.$coverName;
        $cover = InterventionImage::make($file)
            ->resize($width, $height)
            ->save($coverPath);

        return $destination.'/'.$coverName;
    }
}

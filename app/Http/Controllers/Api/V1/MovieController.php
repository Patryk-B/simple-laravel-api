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
use App\Http\Requests\V1\MovieStoreRequest;
use App\Http\Requests\V1\MovieUpdateRequest;

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

        $collection = new MovieCollection($movies->paginate()->appends($request->query()));
        return $collection;
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
    public function store(MovieStoreRequest $request)
    {
        // Validate request:
        $validated = $request->validated(); // will throw `ValidationException` on invalid data.

        // Create new movie:
        $movie = Movie::create([
            'title' => $validated['title'],
            'cover' => MovieController::resizeCover($validated['cover']),
            'country' => $validated['country'],
            'description' => $validated['description']
        ]);

        // Attach genres:
        $GenreUUIDs = MovieController::getGenreUUIDs(
            $validated['genres']
        );
        $movie->genres()->attach($GenreUUIDs);

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
    public function update(MovieUpdateRequest $request, Movie $movie)
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
               'cover' => MovieController::resizeCover($validated['cover'])
            ]);
        }

        // Update genres (detach old & attach new):
        $GenreUUIDs = MovieController::getGenreUUIDs(
            $validated['genres'] ?? $movie->genres()->get()->pluck('name')
        );
        $movie->genres()->detach();
        $movie->genres()->attach($GenreUUIDs);

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
     * parse genres
     */
    public static function getGenreUUIDs(array $genres)
    {
        $GenreUUIDs = Genre::whereIn('name', $genres)->pluck('id')->toArray();
        return $GenreUUIDs;
    }

    /**
     * resize image before uploading
     */
    public static function resizeCover(UploadedFile $file)
    {
        $width = 500;
        $height = 500;
        $destination = 'cover';
        Storage::makeDirectory($destination, 0755);
        $coverName = Str::orderedUuid().'.'.$file->extension();
        $coverAbsolutePath = storage_path('app/'.$destination).'/'.$coverName;
        $cover = InterventionImage::make($file)
            ->resize($width, $height)
            ->save($coverAbsolutePath);

        return $destination.'/'.$coverName;
    }
}

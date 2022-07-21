<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;
use App\Interfaces\DummyModelRepositoryInterface;
use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

class MovieController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(DummyModelRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movieList = $this->movieRepository->browseMovie();
   
        return Inertia::render('Movies/Index', [
            'items' => $movieList,
            'create_url' => URL::route('movies.create'),
            'modelName' => 'movies'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Movies/CreateAndUpdate', [
            'method' => 'create',
            'modelName' => 'movies'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {
        $this->movieRepository->addMovie($request->validated());
        return Redirect::route('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return Inertia::render('Movies/CreateAndUpdate', [
            'item' => $movie,
            'method' => 'edit',
            'modelName' => 'movies'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $updatedMovie = $this->movieRepository->editMovie($movie, $request->validated());
        return Redirect::route('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $deletedMovie = $this->movieRepository->deleteMovie($movie);
        return Redirect::route('movies.index');
    }
}

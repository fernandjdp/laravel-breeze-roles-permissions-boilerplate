<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSerieRequest;
use App\Http\Requests\UpdateSerieRequest;
use App\Models\Serie;
use App\Interfaces\DummyModelRepositoryInterface;
use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

class SerieController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(DummyModelRepositoryInterface $serieRepository)
    {
        $this->serieRepository = $serieRepository;
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serieList = $this->serieRepository->browseSerie();
   
        return Inertia::render('Series/Index', [
            'items' => $serieList,
            'create_url' => URL::route('series.create'),
            'modelName' => 'series'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Series/CreateAndUpdate', [
            'method' => 'create',
            'modelName' => 'series'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSerieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSerieRequest $request)
    {
        $this->serieRepository->addSerie($request->validated());
        return Redirect::route('series.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $series)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $series)
    {
        return Inertia::render('Series/CreateAndUpdate', [
            'item' => $series,
            'method' => 'edit',
            'modelName' => 'series'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSerieRequest  $request
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSerieRequest $request, Serie $series)
    {
        $updatedSerie = $this->serieRepository->editSerie($series, $request->validated());
        return Redirect::route('series.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $series)
    {
        $deletedSerie = $this->serieRepository->deleteSerie($series);
        return Redirect::route('series.index');
    }
}

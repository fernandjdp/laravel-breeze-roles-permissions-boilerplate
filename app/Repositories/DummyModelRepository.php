<?php

namespace App\Repositories;

use App\Interfaces\DummyModelRepositoryInterface;
use App\Models\Book;
use App\Models\Serie;
use App\Models\Movie;

class DummyModelRepository implements DummyModelRepositoryInterface 
{
    public function browseBook() {
        return Book::all()->toArray();
    }
    public function browseMovie() {
        return Movie::all()->toArray();
    }
    public function browseSerie() {
        return Serie::all()->toArray();
    }

    public function editBook($bookModel, $bookData) {
        return $bookModel->update($bookData);
    }
    public function editMovie($movieModel, $movieData) {
        return $movieModel->update($movieData);
    }
    public function editSerie($serieModel, $serieData) {
        return $serieModel->update($serieData);
    }

    public function addBook($bookData) {
        return Book::create($bookData);
    }
    public function addMovie($movieData) {
        return Movie::create($movieData);
    }
    public function addSerie($serieData) {
        return Serie::create($serieData);
    }
    
    public function deleteBook($bookModel) {
        return $bookModel->delete();
    }
    public function deleteMovie($movieModel) {
        return $movieModel->delete();
    }
    public function deleteSerie($serieModel) {
        return $serieModel->delete();
    }
}
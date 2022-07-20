<?php

namespace App\Repositories;

use App\Interfaces\DummyModelRepositoryInterface;

class DummyModelRepository implements DummyModelRepositoryInterface 
{
    public function browseBook() {
        
    }
    public function browseMovie() {
        
    }
    public function browseSerie() {
        
    }

    public function editBook($bookModel, $bookData) {
        
    }
    public function editMovie($movieModel, $movieData) {
        
    }
    public function editSerie($serieModel, $serieData) {
        
    }

    public function addBook($bookData) {
        
    }
    public function addMovie($movieData) {
        
    }
    public function addSerie($serieData) {
        
    }
    
    public function deleteBook($bookModel) {
        
    }
    public function deleteMovie($movieModel) {
        
    }
    public function deleteSerie($serieModel) {
        
    }
}
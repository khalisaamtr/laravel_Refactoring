<?php 

namespace App\Services\Interface;

interface MovieServiceInterface{
    public function getMovie($search);
    public function getMovieById($sid);
    public function getAllMovies();
    public function getCategories();
    public function CreateMovie($data, $file = null);
    public function updateMovie($id, $data, $file = null);
    public function deleteMovie($id);
}

?>
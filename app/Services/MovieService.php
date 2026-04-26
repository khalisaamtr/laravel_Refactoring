<?php

namespace App\Services;

use App\Repositories\Interface\MovieRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Services\Interface\MovieServiceInterface;

class MovieService implements MovieServiceInterface {
    protected $movieRepository;
    
    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }
    
    public function getMovie($search) {
        return $this->movieRepository->getAllWithSearch($search);
    }
    
    public function getMovieById($id) {
        return $this->movieRepository->getById($id);
    }
    
    public function getAllMovies() {
        return $this->movieRepository->getAllPaginated();
    }
    
    public function getCategories() {
        return $this->movieRepository->getCategories();
    }
    
    public function CreateMovie($data, $file = null) {
        if ($file) {
            $data['foto_sampul'] = $file->store('movie_covers', 'public');
        }
        return $this->movieRepository->create($data);
    }
    
    public function updateMovie($id, $data, $file = null) {
        $movie = $this->movieRepository->getById($id);
        
        if ($file) {
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            
            if ($movie->foto_sampul && File::exists(public_path('images/' . $movie->foto_sampul))) {
                File::delete(public_path('images/' . $movie->foto_sampul));
            }
            
            $data['foto_sampul'] = $fileName;
        }
        
        return $this->movieRepository->update($movie, $data);
    }
    
    public function deleteMovie($id){
        $movie = $this->movieRepository->getById($id);
        
        if ($movie->foto_sampul && File::exists(public_path('images/' . $movie->foto_sampul))) {
            File::delete(public_path('images/' . $movie->foto_sampul));
        }
        
        return $this->movieRepository->delete($movie);
    }
}

?>
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'sinopsis',
        'foto_sampul',
        'category_id', // sesuaikan dengan kolom di database kamu
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
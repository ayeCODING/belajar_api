<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['judul','deskripsi','foto','url_video','id_kategori'];

    use HasFactory;

    public function Kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
    public function Genre(){
        return $this->belongsToMany(Genre::class, 'genre_films', 'id_film', 'id_genre');
    }
    public function Aktor(){
        return $this->belongsToMany(Aktor::class, 'aktor_films', 'id_film', 'id_aktor');
    }
}

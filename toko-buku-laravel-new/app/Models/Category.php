<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Menambahkan properti yang diizinkan untuk diisi mass-assignment
    protected $fillable = ['name'];

    /**
     * Relasi satu kategori memiliki banyak buku.
     */
    public function books()
    {
        return $this->hasMany(Book::class); // Satu kategori dapat memiliki banyak buku
    }

    /**
     * Relasi satu kategori memiliki banyak testimoni.
     */
    public function testimonis()
    {
        return $this->hasMany(Testimoni::class); // Satu kategori dapat memiliki banyak testimoni
    }
}

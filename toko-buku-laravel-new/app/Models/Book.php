<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'genre',
        'price',
        'image',
        'user_id', // Pastikan ada user_id
        'category_id' // Pastikan ada category_id
    ];

    /**
     * Mendapatkan URL penuh untuk gambar buku.
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => url('storage/books/' . $image),
        );
    }

    /**
     * Relasi Buku dengan Kategori (Many-to-One).
     * Setiap buku terkait dengan satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class); // Satu buku dimiliki oleh satu kategori
    }

    /**
     * Relasi Buku dengan Pengguna (Many-to-One).
     * Setiap buku terkait dengan satu pengguna (misalnya pemilik buku).
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Satu buku dimiliki oleh satu pengguna
    }
}

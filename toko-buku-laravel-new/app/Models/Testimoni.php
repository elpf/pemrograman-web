<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Testimoni extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'category_id',
    ];

    /**
     * Accessor untuk 'name' - mengubah nama menjadi kapital pertama
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
        );
    }

    /**
     * Relasi Testimoni dengan User (Many-to-One).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi Testimoni dengan Category (Many-to-One).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

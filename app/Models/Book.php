<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        "title",
        "author",
        "publisher",
        "year",
        "stock",
        'cover_image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}

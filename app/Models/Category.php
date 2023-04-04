<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'status'];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'cate_books', 'cate_id', 'book_id')->using(CateBook::class)->withTimestamps();
    }
}

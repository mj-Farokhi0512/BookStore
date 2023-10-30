<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Book extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    //    protected $fillable = ['name', 'status'];

    protected $cascadeDeletes = ['tags', 'categories', 'orders', 'bookmarks'];
    protected $guarded = [];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($book) {
    //         $book->tags()->delete();
    //         $book->orders()->delete();
    //         $book->categories()->delete();
    //         $book->bookmarks()->delete();
    //     });
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'cate_books', 'book_id', 'cate_id')->using(CateBook::class)->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_books')->using(TagBook::class)->withTimestamps();
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_books')->using(UserBook::class)->withTimestamps();
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
}

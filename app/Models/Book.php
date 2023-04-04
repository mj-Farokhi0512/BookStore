<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    //    protected $fillable = ['name', 'status'];
    protected $guarded = [];

    public function user(): BelongsToMany
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
}

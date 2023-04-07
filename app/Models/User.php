<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, CascadeSoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $cascadeDeletes = ['books', 'orders', 'bookmarks'];
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function role(): BelongsTo
    // {
    //     return $this->belongsTo(Role::class);
    // }

    //    public function roles(): BelongsToMany
    //    {
    //        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    //    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'creator');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'user_books')->using(UserBook::class)->withPivot('id', 'number', 'paid', 'deleted_at')->withTimestamps();
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'likes')->withTimestamps();
    }
}

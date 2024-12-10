<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function favoriteBooks()
    {
        return $this->belongsToMany(Book::class, 'book_user');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    // Get transactions for the logged-in user (through categories)
    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Category::class);
    }
}

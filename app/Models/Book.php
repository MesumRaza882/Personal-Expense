<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\GlobalScopesTrait;

class Book extends Model
{
    use HasFactory,GlobalScopesTrait;

    protected $guarded = ['id'];

    // Define polymorphic relationship for images
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'other');
    }

    // Define polymorphic relationship for cover image
    public function coverImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'cover');
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'book_user');
    }
}

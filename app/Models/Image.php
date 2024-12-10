<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'type'];
    protected $appends = ['url1'];

    // Define polymorphic relationship
    public function imageable()
    {
        return $this->morphTo();
    }

    // Generate the full image URL
    public function getUrl1Attribute()
    {
        return asset(Storage::url($this->url));
    }
}

<?php
// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalScopesTrait;

class Category extends Model
{
    use HasFactory, GlobalScopesTrait;

    protected $fillable = ['user_id', 'name', 'type', 'parent_id'];

    // Category can have many subcategories (self-referencing relationship)
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Category belongs to a parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Category belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Category has many transactions through itself
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}

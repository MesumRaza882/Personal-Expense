<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalScopesTrait;

class Entry extends Model
{
    use GlobalScopesTrait;
    
    protected $fillable = ['record_id', 'category_id', 'amount', 'status','description'];

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilterByCategory($query, $parentCategoryId, $categoryId)
    {
        if ($categoryId) {
            return $query->where('category_id', $categoryId);
        } elseif ($parentCategoryId) {
            $parentCategory = Category::with('subCategories')->find($parentCategoryId);
            $categoryIds = $parentCategory->subCategories->pluck('id')->push($parentCategory->id);
            return $query->whereIn('category_id', $categoryIds);
        }

        return $query;
    }
}

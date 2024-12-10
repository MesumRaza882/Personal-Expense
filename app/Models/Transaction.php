<?php
// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalScopesTrait;

class Transaction extends Model
{
    use HasFactory,GlobalScopesTrait;

    protected $fillable = ['category_id', 'amount', 'description', 'date', 'status'];

    // Transaction belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

   // Dynamic scope to filter by category type (udhaar, income, expense)
    public function scopeByCategoryType($query, $type)
    {
        return $query->whereHas('category', function ($q) use ($type) {
            $q->where('type', $type);
        });
    }
}

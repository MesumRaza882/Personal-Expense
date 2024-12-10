<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalScopesTrait;

class Record extends Model
{
    use GlobalScopesTrait;
    
    protected $fillable = ['date', 'type', 'status'];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}

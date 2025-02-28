<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Line extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public function categories() : HasMany {
        return $this->hasMany(Category::class);
    }
    
    public function raees() : HasMany {
        return $this->hasMany(Raee::class);
    }
}

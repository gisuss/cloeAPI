<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'line_id'
    ];

    public function line() : BelongsTo {
        return $this->belongsTo(Line::class);
    }

    public function raees() : HasMany {
        return $this->hasMany(Raee::class);
    }

    public function scopeFilterByLine($query, $filters) {
        $query->when($filters['line_id'] ?? null, function($query, $lineID) {
            $query->where('line_id', $lineID);
        });
    }
}

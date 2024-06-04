<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Raee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'centro_id',
        'brand_id',
        'line_id',
        'category_id',
        'clasified_by',
        'model',
        'information',
        'status'
    ];

    public function centroAcopio() : BelongsTo {
        return $this->belongsTo(CentroAcopio::class, 'centro_id');
    }
    
    public function marca() : BelongsTo {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    
    public function linea() : BelongsTo {
        return $this->belongsTo(Line::class, 'line_id');
    }
    
    public function category() : BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function clasificador() : BelongsTo {
        return $this->belongsTo(User::class, 'clasified_by');
    }

    public function components() {
        return $this->hasMany(Component::class);
    }

    public function scopeStatus($query, $filters) {
        $query->when($filters['status'] ?? null, function($query, $status) {
            $query->where('status', $status);
        });
    }

    public function scopeType($query, $type) {
        $query->when($type ?? null, function($query, $type) {
            $query->where('status', $type);
        });
    }
}

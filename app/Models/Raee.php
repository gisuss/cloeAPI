<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->belongsTo(CentroAcopio::class);
    }
    
    public function marca() : BelongsTo {
        return $this->belongsTo(Brand::class);
    }
    
    public function linea() : BelongsTo {
        return $this->belongsTo(Line::class);
    }
    
    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }
    
    public function clasificador() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}

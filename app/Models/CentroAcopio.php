<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CentroAcopio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'encargado_id',
        'estado_id',
        'municipio_id',
        'description',
        'address',
        'active',
        'name'
    ];

    public function encargado() : BelongsTo {
        return $this->belongsTo(User::class, 'encargado_id');
    }

    public function estado() : BelongsTo {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function municipio() : BelongsTo {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function raees() : HasMany {
        return $this->hasMany(Raee::class);
    }
    
    public function users() : HasMany {
        return $this->hasMany(User::class);
    }

    public function scopeFilterLocation($query, $filters) {
        $query->when($filters['estado_id'] ?? null, function($query, $estadoID) {
            $query->where('estado_id', $estadoID);
        })->when($filters['municipio_id'] ?? null, function($query, $municipioID) {
            $query->where('municipio_id', $municipioID);
        })->where('active', true);
    }
}

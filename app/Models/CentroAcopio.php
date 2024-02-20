<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'ciudad_id',
        'description',
        'address',
        'active',
    ];

    public function encargado() : BelongsTo {
        return $this->belongsTo(User::class, 'encargado_id');
    }

    public function estado() : BelongsTo {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function ciudad() : BelongsTo {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    public function scopeFilterLocation($query, $filters) {
        $query->when($filters['estado_id'] ?? null, function($query, $estadoID) {
            $query->where('estado_id', $estadoID);
        })->when($filters['ciudad_id'] ?? null, function($query, $ciudadID) {
            $query->where('ciudad_id', $ciudadID);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Component extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'weight',
        'dimensions',
        'reusable',
        'separated_by',
        'raee_id',
        'observations'
    ];

    public function materials() : BelongsToMany {
        return $this->belongsToMany(Material::class);
    }
    
    public function processes() : BelongsToMany {
        return $this->belongsToMany(Proceso::class);
    }

    public function raee() : BelongsTo {
        return $this->belongsTo(Raee::class);
    }

    public function splitedBy() : BelongsTo {
        return $this->belongsTo(User::class, 'separated_by');
    }
}

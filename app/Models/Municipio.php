<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipio extends Model{

	protected $table = 'municipios';
	public $timestamps = false;

    public function estado()
    {
        return $this->belongsTo('Estado', 'estado_id', 'id');
    }

	public function parroquias()
    {
        return $this->hasMany('Parroquia', 'municipio_id', 'id');
    }

    public function users() : HasMany {
        return $this->hasMany(User::class);
    }

    public function scopeFilterByState($query, $filters) {
        $query->when($filters['estado_id'] ?? null, function($query, $estadoID) {
            $query->where('estado_id', $estadoID);
        });
    }
}
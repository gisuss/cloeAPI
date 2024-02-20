<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model {

	protected $table = 'ciudades';
	public $timestamps = false;

	public function estado()
    {
        return $this->belongsTo('Estado', 'estado_id', 'id');
    }

    public function scopeFilterByState($query, $filters) {
        $query->when($filters['estado_id'] ?? null, function($query, $estadoID) {
            $query->where('estado_id', $estadoID);
        });
    }
}
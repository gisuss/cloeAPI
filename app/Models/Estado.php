<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model {

    protected $table = 'estados';
	
	public $timestamps = false;

    public function municipios() {
        return $this->hasMany('Municipio','estado_id');
    }
    
    public function users() : HasMany {
        return $this->hasMany(User::class);
    }
}
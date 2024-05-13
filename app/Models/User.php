<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\{HasApiTokens, NewAccessToken};
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasOne};
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'ci_id',
        'email',
        'username',
        'active',
        'password',
        'enabled',
        'estado_id',
        'municipio_id',
        'centro_id',
        'address',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Create a new personal access token for the user.
     *
     * @param  string  $name
     * @param  array  $abilities
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createToken(string $name, array $abilities = ['*'])
    {
        $token = $this->tokens()->create([
            'name'       => $name,
            'token'      => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities'  => $abilities,
            'expires_at' => Carbon::now()->addDays(1), //token lifetime
        ]);

        return new NewAccessToken($token, $token->getKey() . '|' . $plainTextToken);
    }

    public function cedula() : BelongsTo {
        return $this->belongsTo(Identification::class, 'ci_id');
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

    public function centro() : BelongsTo {
        return $this->belongsTo(CentroAcopio::class, 'centro_id');
    }
}

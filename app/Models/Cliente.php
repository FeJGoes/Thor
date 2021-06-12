<?php

namespace App\Models;

use App\Models\Plano;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Cliente extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clientes';

    /**
     * The name of the "created at" column.
     *
     * @var string|null
     */
    const CREATED_AT = 'criado_em';

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = 'atualizado_em';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ativo',
        'nome',
        'senha',
        'email',
        'telefone',
        'estado',
        'cidade',
        'data_nascimento',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ativo' => 'boolean',
        'nome' => 'string',
        'senha' => 'string',
        'email' => 'string',
        'telefone' => 'string',
        'estado' => 'string',
        'cidade' => 'string',
        'data_nascimento' => 'datetime:d/m/Y',
        'avatar' => 'string',
        'criado_em' => 'datetime:d/m/Y H:i:s',
        'atualizado_em' => 'datetime:d/m/Y H:i:s',
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    /**
     * Aplica a hash sobre a senha do cliente.
     *
     * @param  string  $value
     * @return void
     */
    public function setSenhaAttribute($value)
    {
        $this->attributes['senha'] = Hash::make($value);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Planos viculados ao cliente
     */
    public function planos()
    {
        return $this->belongsToMany(Plano::class, 'clientes_planos');
    }
}

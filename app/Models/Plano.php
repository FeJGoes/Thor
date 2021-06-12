<?php

namespace App\Models;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plano extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'planos';

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
        'tipo',
        'mensalidade',
        'criado_em',
        'atualizado_em',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ativo' => 'boolean',
        'tipo' => 'string',
        'mensalidade' => 'decimal:2',
        'criado_em' => 'datetime:d/m/Y H:i:s',
        'atualizado_em' => 'datetime:d/m/Y H:i:s',
    ];

    /**
     * Clintes viculados ao plano
     */
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class);
    }
}

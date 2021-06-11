<?php

namespace App\Models\Relationships;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClientePlano extends Pivot
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clientes_planos';


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
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'plano_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cliente_id' => 'integer',
        'plano_id' => 'integer',
        'criado_em' => 'datetime:d/m/Y H:i:s',
    ];
}

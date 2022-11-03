<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo',
        'razonSocial',
        'nombres',
        'apellidos',
        'activo',
        'eMail',
        'direccion_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'activo' => 'boolean',
        'direccion_id' => 'integer',
    ];

    public function direccions()
    {
        return $this->belongsToMany(Direccion::class, 'direcciones');
    }

    public function clienteIndices()
    {
        return $this->morphedByMany(Cliente::class, 'entidadable');
    }

    public function vendedorIndices()
    {
        return $this->morphedByMany(Vendedor::class, 'entidadable');
    }

    public function perfilIndices()
    {
        return $this->morphedByMany(Perfil::class, 'entidadable');
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }
}

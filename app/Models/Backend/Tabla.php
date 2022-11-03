<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabla extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tabla',
        'tabla_id',
        'nombre',
        'descripcion',
        'valor1',
        'valor2',
        'valor3',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tabla' => 'integer',
        'tabla_id' => 'integer',
        'valor1' => 'decimal:2',
        'valor3' => 'boolean',
    ];
}

<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marcador extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'marcadores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'babosa', 'hexa', 'imagen', 'rgb', 'metadata', 'activo'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'metadata' => 'array',
        'activo' => 'boolean',
    ];

    public function postIndices()
    {
        return $this->morphedByMany(\App\Models\posts\Post::class, 'marcadorable');
    }

    public function videoIndices()
    {
        return $this->morphedByMany(\App\Models\posts\Video::class, 'marcadorable');
    }

    public function imagenIndices()
    {
        return $this->morphedByMany(\App\Models\posts\Imagen::class, 'marcadorable');
    }
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
}

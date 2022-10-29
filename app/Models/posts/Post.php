<?php

namespace App\Models\posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'contenido',
        'publicado',
        'actualizado',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'publicado' => 'timestamp',
        'actualizado' => 'timestamp',
    ];

    public function marcadorables()
    {
        return $this->morphToMany(\App\Models\backend\Marcador::class, 'marcadorableable');
    }

    public function categoriables()
    {
        return $this->morphToMany(\App\Models\backend\Categoria::class, 'categoriableable');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
